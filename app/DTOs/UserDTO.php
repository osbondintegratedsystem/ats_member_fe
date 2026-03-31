<?php

namespace App\DTOs;

class UserDTO
{
    public function __construct(
        public readonly string $username,
        public readonly string $name,
        public readonly string $role,
        public readonly string $status
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            username: $data['id'] ?? $data['username'] ?? '',
            name: $data['name'] ?? '',
            role: $data['role'] ?? 'Receptionist',
            status: $data['status'] ?? 'ACTIVE'
        );
    }
}
