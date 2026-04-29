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
    ) {
    }

    public static function fromArray(array $data): self
    {
        $date = $data['date'] ?? '';
        $time = $data['time'] ?? '';
        $dateTime = trim("$date $time");

        return new self(
            dateTime: $dateTime ?: ($data['date_time'] ?? $data['created_at'] ?? now()->format('Y-m-d H:i:s')),
            memberId: $data['nik'] ?? $data['member_id'] ?? 'N/A',
            memberName: $data['member'] ?? $data['member_name'] ?? '',
            clubName: $data['club'] ?? $data['club_name'] ?? '',
            type: $data['type'] ?? 'CHECK IN'
        );
    }
}
