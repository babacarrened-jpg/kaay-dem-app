<?php
// app/enums/ReservationStatus.php

enum ReservationStatus: string {
    case EN_ATTENTE = 'en_attente';
    case CONFIRMEE = 'confirmee';
    case TERMINEE = 'termine';
    case ANNULEE = 'annulee';
}
