<?php
// app/interfaces/EvaluableInterface.php

interface EvaluableInterface {
    public function addRating(int $entityId, int $rating, string $comment): bool;
    public function getAverageRating(int $entityId): float;
}
