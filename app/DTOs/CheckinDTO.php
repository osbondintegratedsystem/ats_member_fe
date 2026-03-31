<?php

namespace App\DTOs;

class CheckinDTO
{
    public function __construct(
        public readonly string $dateTime,
        public readonly string $memberId,
        public readonly string $memberName,
        public readonly string $clubName,
        public readonly string $type // CHECK IN or CHECK OUT
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            dateTime: $data['date_time'] ?? $data['created_at'] ?? now()->format('Y-m-d H:i:s'),
            memberId: $data['member_id'] ?? '',
            memberName: $data['member_name'] ?? '',
            clubName: $data['club_name'] ?? $data['club'] ?? '',
            type: $data['type'] ?? 'CHECK IN'
        );
    }
}
