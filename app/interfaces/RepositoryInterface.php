<?php
// app/interfaces/RepositoryInterface.php

interface RepositoryInterface {
    public function findById(int $id);
    public function findAll(): array;
    public function save(array $data): bool;
    public function delete(int $id): bool;
}
