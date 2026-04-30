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
            $response = $this->api->get('/club/list', ['search' => 'all']);
            if (isset($response['error']) || ($response['isSuccess'] ?? false) === false) {
                return [];
            }
            return $response['clubs'] ?? [];
        });
    }

    public function create(array $data): array
    {
        $response = $this->api->post('/club/add', [
            'id' => $data['id'] ?? '',
            'name' => $data['name'] ?? ''
        ]);
        if (empty($response['error'])) {
            Cache::forget('clubs.all');
        }
        return $response;
    }

    public function update(string $id, array $data): array
    {
        $response = $this->api->post("/club/edit", [
            'id' => $id,
            'name' => $data['name'] ?? ''
        ]);
        if (empty($response['error'])) {
            Cache::forget('clubs.all');
        }
        return $response;
    }

    public function delete(string $id): array
    {
        $response = $this->api->post("/club/delete", ['id' => $id]);
        if (empty($response['error'])) {
            Cache::forget('clubs.all');
        }
        return $response;
    }
}
