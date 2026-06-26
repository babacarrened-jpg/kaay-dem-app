<?php
// app/traits/Timestampable.php

trait Timestampable {
    protected ?string $created_at = null;
    protected ?string $updated_at = null;

    public function setCreatedAt(string $datetime): void {
        $this->created_at = $datetime;
    }

    public function setUpdatedAt(string $datetime): void {
        $this->updated_at = $datetime;
    }

    public function getCreatedAt(): ?string {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?string {
        return $this->updated_at;
    }
}
