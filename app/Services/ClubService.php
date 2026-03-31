<?php

namespace App\Services;

use App\Clients\ApiClient;
use Illuminate\Support\Facades\Cache;

class ClubService
{
    public function __construct(protected ApiClient $api)
    {
    }

    public function getAll(): array
    {
        return Cache::remember('clubs.all', 300, function () {
            $response = $this->api->get('/admin/clubs');
            if (isset($response['error'])) {
                return [];
            }
            return $response['data'] ?? $response;
        });
    }

    public function create(array $data): array
    {
        $response = $this->api->post('/admin/clubs', $data);
        if (empty($response['error'])) {
            Cache::forget('clubs.all');
        }
        return $response;
    }

    public function update(string $id, array $data): array
    {
        $response = $this->api->put("/admin/clubs/{$id}", $data);
        if (empty($response['error'])) {
            Cache::forget('clubs.all');
        }
        return $response;
    }

    public function delete(string $id): array
    {
        $response = $this->api->delete("/admin/clubs/{$id}");
        if (empty($response['error'])) {
            Cache::forget('clubs.all');
        }
        return $response;
    }
}
