<?php
// app/exceptions/PlacesInsuffisantesException.php

class PlacesInsuffisantesException extends Exception {
    public function __construct(string $message = "Pas assez de places disponibles.", int $code = 0, ?Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
