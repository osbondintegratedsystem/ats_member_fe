<?php

namespace App\DTOs;

class MemberDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $package,
        public readonly string $expirationDate,
        public readonly string $phone,
        public readonly string $status = 'ACTIVE'
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? '',
            name: $data['name'] ?? '',
            package: $data['package'] ?? 'N/A',
            expirationDate: $data['expiration_date'] ?? $data['exp_date'] ?? '',
            phone: $data['hp'] ?? $data['phone'] ?? '',
            status: $data['status'] ?? 'ACTIVE'
        );
    }
}
