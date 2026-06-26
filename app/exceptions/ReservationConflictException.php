<?php
// app/exceptions/ReservationConflictException.php

class ReservationConflictException extends Exception {
    public function __construct(string $message = "Vous avez déjà une réservation sur cette journée.", int $code = 0, ?Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
