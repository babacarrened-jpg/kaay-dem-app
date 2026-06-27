const express = require('express');
const http = require('http');
const path = require('path');
const cors = require('cors');
const { Server } = require('socket.io');
const { v4: uuidv4 } = require('uuid');

const app = express();
const server = http.createServer(app);
const io = new Server(server, {
  cors: {
    origin: '*',
    methods: ['GET', 'POST']
  }
});

app.use(cors());
app.use(express.json());
app.use(express.static(path.join(__dirname, 'public')));

const drivers = [
  {
    id: 'driver1',
    name: 'Amadou Diallo',
    phone: '+221772345678',
    photo: 'https://ui-avatars.com/api/?name=Amadou+Diallo&background=167F92&color=ffffff',
    plate: 'SN-001-AAA',
    rating: 4.9,
    available: true,
    vehicle: 'Toyota Corolla',
    location: { lat: 14.7335, lng: -17.4680 }
  }
];

const passengers = [
  {
    id: 'passenger1',
    name: 'Aïssatou Ndiaye'
  }
];

const rides = [];
const driverPositions = new Map();
const userSockets = new Map();

const toRadians = (degrees) => degrees * (Math.PI / 180);
const haversineDistance = (lat1, lng1, lat2, lng2) => {
  const R = 6371000;
  const dLat = toRadians(lat2 - lat1);
  const dLng = toRadians(lng2 - lng1);
  const a = Math.sin(dLat / 2) ** 2 + Math.cos(toRadians(lat1)) * Math.cos(toRadians(lat2)) * Math.sin(dLng / 2) ** 2;
  return R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
};

const findNearbyDrivers = (lat, lng, radiusMeters = 7000) => {
  return drivers
    .filter((driver) => driver.available)
    .map((driver) => ({
      ...driver,
      distance: haversineDistance(lat, lng, driver.location.lat, driver.location.lng)
    }))
    .filter((driver) => driver.distance <= radiusMeters)
    .sort((a, b) => a.distance - b.distance);
};

const broadcastRideRequests = (ride, candidates) => {
  candidates.forEach((driver) => {
    io.to(`driver:${driver.id}`).emit('ride:request', {
      rideId: ride.id,
      passengerId: ride.passengerId,
      pickup: ride.pickup,
      dropoff: ride.dropoff,
      distance: ride.distance,
      duration: ride.duration,
      fare: ride.fare,
      passengerName: ride.passengerName,
      status: ride.status
    });
  });
};

app.get('/health', (req, res) => {
  res.json({ status: 'ok' });
});

app.get('/drivers/nearby', (req, res) => {
  const lat = parseFloat(req.query.lat);
  const lng = parseFloat(req.query.lng);
  const radius = parseInt(req.query.radius || '7000', 10);

  if (Number.isNaN(lat) || Number.isNaN(lng)) {
    return res.status(400).json({ error: 'lat and lng are required' });
  }

  const result = findNearbyDrivers(lat, lng, radius).map((driver) => ({
    id: driver.id,
    name: driver.name,
    phone: driver.phone,
    plate: driver.plate,
    rating: driver.rating,
    vehicle: driver.vehicle,
    distance: Math.round(driver.distance)
  }));

  res.json({ drivers: result });
});

app.post('/rides', (req, res) => {
  const { passengerId, pickup, dropoff, passengerName, distance, duration, fare } = req.body;

  if (!passengerId || !pickup || !dropoff) {
    return res.status(400).json({ error: 'passengerId, pickup and dropoff are required' });
  }

  const ride = {
    id: uuidv4(),
    passengerId,
    passengerName: passengerName || 'Passager',
    pickup,
    dropoff,
    distance: distance || 0,
    duration: duration || 0,
    fare: fare || 0,
    status: 'waiting',
    driverId: null,
    driverInfo: null,
    createdAt: new Date().toISOString()
  };

  rides.push(ride);

  const nearby = findNearbyDrivers(pickup.lat, pickup.lng, 10000);
  broadcastRideRequests(ride, nearby);

  res.status(201).json({ ride, nearbyDrivers: nearby.slice(0, 5) });
});

app.post('/rides/:id/accept', (req, res) => {
  const rideId = req.params.id;
  const { driverId } = req.body;
  const ride = rides.find((rideItem) => rideItem.id === rideId);
  const driver = drivers.find((d) => d.id === driverId);

  if (!ride || !driver) {
    return res.status(404).json({ error: 'Ride or driver not found' });
  }

  if (ride.status !== 'waiting') {
    return res.status(409).json({ error: 'Ride is not waiting for a driver' });
  }

  ride.status = 'driver_found';
  ride.driverId = driver.id;
  ride.driverInfo = {
    id: driver.id,
    name: driver.name,
    phone: driver.phone,
    photo: driver.photo,
    plate: driver.plate,
    rating: driver.rating,
    vehicle: driver.vehicle
  };

  driver.available = false;

  io.to(`passenger:${ride.passengerId}`).emit('ride:accepted', ride);
  io.to(`driver:${driver.id}`).emit('ride:accepted', ride);
  io.to(`ride:${ride.id}`).emit('ride:statusUpdate', { rideId: ride.id, status: ride.status });

  res.json({ ride });
});

app.post('/rides/:id/status', (req, res) => {
  const rideId = req.params.id;
  const { status } = req.body;
  const ride = rides.find((rideItem) => rideItem.id === rideId);

  if (!ride) {
    return res.status(404).json({ error: 'Ride not found' });
  }

  ride.status = status;

  if (status === 'ride_ended' || status === 'cancelled') {
    const driver = drivers.find((d) => d.id === ride.driverId);
    if (driver) {
      driver.available = true;
    }
  }

  io.to(`passenger:${ride.passengerId}`).emit('ride:statusUpdate', { rideId: ride.id, status });
  io.to(`driver:${ride.driverId}`).emit('ride:statusUpdate', { rideId: ride.id, status });
  io.to(`ride:${ride.id}`).emit('ride:statusUpdate', { rideId: ride.id, status });

  res.json({ ride });
});

app.get('/rides/:id', (req, res) => {
  const ride = rides.find((rideItem) => rideItem.id === req.params.id);

  if (!ride) {
    return res.status(404).json({ error: 'Ride not found' });
  }

  res.json({ ride });
});

io.on('connection', (socket) => {
  console.log('socket connected', socket.id);

  socket.on('register', (payload) => {
    if (!payload || !payload.type || !payload.userId) {
      return;
    }

    const room = `${payload.type}:${payload.userId}`;
    socket.join(room);
    userSockets.set(payload.userId, socket.id);
    console.log(`Socket ${socket.id} joined ${room}`);
  });

  socket.on('driver:position', (data) => {
    if (!data || !data.driverId) {
      return;
    }

    driverPositions.set(data.driverId, {
      lat: data.lat,
      lng: data.lng,
      speed: data.speed || 0,
      heading: data.heading || 0,
      timestamp: data.timestamp || new Date().toISOString()
    });

    const ride = rides.find((rideItem) => rideItem.driverId === data.driverId && rideItem.status !== 'ride_ended' && rideItem.status !== 'cancelled');
    if (ride) {
      const payload = {
        rideId: ride.id,
        driverId: data.driverId,
        lat: data.lat,
        lng: data.lng,
        speed: data.speed || 0,
        heading: data.heading || 0,
        timestamp: data.timestamp || new Date().toISOString()
      };

      io.to(`passenger:${ride.passengerId}`).emit('ride:positionUpdate', payload);
      io.to(`ride:${ride.id}`).emit('ride:positionUpdate', payload);
    }
  });

  socket.on('ride:accept', (payload) => {
    if (!payload || !payload.rideId || !payload.driverId) {
      return;
    }

    const ride = rides.find((rideItem) => rideItem.id === payload.rideId);
    const driver = drivers.find((d) => d.id === payload.driverId);

    if (!ride || !driver || ride.status !== 'waiting') {
      return;
    }

    ride.status = 'driver_found';
    ride.driverId = driver.id;
    ride.driverInfo = {
      id: driver.id,
      name: driver.name,
      phone: driver.phone,
      photo: driver.photo,
      plate: driver.plate,
      rating: driver.rating,
      vehicle: driver.vehicle
    };

    driver.available = false;

    io.to(`passenger:${ride.passengerId}`).emit('ride:accepted', ride);
    io.to(`driver:${driver.id}`).emit('ride:accepted', ride);
    io.to(`ride:${ride.id}`).emit('ride:statusUpdate', { rideId: ride.id, status: ride.status });
  });

  socket.on('disconnect', () => {
    console.log('socket disconnected', socket.id);
  });
});

const PORT = process.env.PORT || 3000;
server.listen(PORT, () => {
  console.log(`VTC realtime server listening on http://localhost:${PORT}`);
});
