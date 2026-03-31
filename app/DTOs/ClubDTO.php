<?php

namespace App\DTOs;

class ClubDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $name
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? $data['club_id'] ?? '',
            name: $data['name'] ?? $data['club_name'] ?? ''
        );
    }
}
