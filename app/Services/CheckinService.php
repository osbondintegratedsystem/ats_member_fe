<?php

namespace App\Services;

use App\Clients\ApiClient;

class CheckinService
{
    public function __construct(protected ApiClient $api)
    {
    }

    public function checkIn(string $memberId): array
    {
        return $this->api->post('/checkin', ['member_id' => $memberId]);
    }

    public function checkOut(string $memberId): array
    {
        return $this->api->post('/checkout', ['member_id' => $memberId]);
    }

    public function recap(?string $startDate, ?string $endDate): array
    {
        $query = [];
        if ($startDate) $query['start_date'] = $startDate;
        if ($endDate) $query['end_date'] = $endDate;

        $response = $this->api->get('/recap', $query);

        if (isset($response['error'])) {
            return [];
        }

        return $response['data'] ?? $response;
    }
}
