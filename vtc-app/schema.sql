-- Schéma de base de données pour prototype VTC

CREATE TABLE users (
    id VARCHAR(50) PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) UNIQUE,
    phone VARCHAR(30),
    role ENUM('passenger', 'driver', 'admin') NOT NULL DEFAULT 'passenger',
    password_hash VARCHAR(255),
    photo VARCHAR(255),
    rating DECIMAL(3,2) DEFAULT 0,
    available BOOLEAN DEFAULT FALSE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE vehicles (
    id VARCHAR(50) PRIMARY KEY,
    driver_id VARCHAR(50) NOT NULL,
    make VARCHAR(80) NOT NULL,
    model VARCHAR(80) NOT NULL,
    plate VARCHAR(30) NOT NULL,
    seats INT DEFAULT 4,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (driver_id) REFERENCES users(id)
);

CREATE TABLE rides (
    id VARCHAR(50) PRIMARY KEY,
    passenger_id VARCHAR(50) NOT NULL,
    driver_id VARCHAR(50),
    pickup_lat DECIMAL(10,7) NOT NULL,
    pickup_lng DECIMAL(10,7) NOT NULL,
    dropoff_lat DECIMAL(10,7) NOT NULL,
    dropoff_lng DECIMAL(10,7) NOT NULL,
    distance_m INT DEFAULT 0,
    duration_s INT DEFAULT 0,
    fare DECIMAL(10,2) DEFAULT 0,
    status ENUM('waiting','driver_found','en_route','arrived','ride_started','ride_ended','payment','cancelled') DEFAULT 'waiting',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (passenger_id) REFERENCES users(id),
    FOREIGN KEY (driver_id) REFERENCES users(id)
);

CREATE TABLE ride_positions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ride_id VARCHAR(50) NOT NULL,
    user_id VARCHAR(50) NOT NULL,
    lat DECIMAL(10,7) NOT NULL,
    lng DECIMAL(10,7) NOT NULL,
    speed DECIMAL(6,2) DEFAULT 0,
    heading DECIMAL(6,2) DEFAULT 0,
    recorded_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ride_id) REFERENCES rides(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(50) NOT NULL,
    type VARCHAR(60) NOT NULL,
    title VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    read_status BOOLEAN DEFAULT FALSE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
