<?php
// app/interfaces/EvaluableInterface.php

interface EvaluableInterface {
    public function addRating(int $trajetId, int $auteurId, int $destinataireId, int $note, string $commentaire = ''): bool;
    public function getAverageRating(int $destinataireId): float;
}