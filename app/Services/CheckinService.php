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
        return $this->api->post('/member/checkin', ['id' => $memberId]);
    }

    public function checkOut(string $memberId): array
    {
        return $this->api->post('/member/checkout', ['id' => $memberId]);
    }

    public function recap(?string $startDate, ?string $endDate): array
    {
        $query = [];
        if ($startDate)
            $query['date_start'] = $startDate;
        if ($endDate)
            $query['date_end'] = $endDate;

        $response = $this->api->get('/recap/list', $query);

        if (isset($response['error']) || ($response['isSuccess'] ?? false) === false) {
            return [];
        }

        return $response['items'] ?? [];
    }
}
