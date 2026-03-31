<?php

namespace App\Services;

use App\Clients\ApiClient;
use Illuminate\Support\Facades\Cache;

class UserService
{
    public function __construct(protected ApiClient $api)
    {
    }

    public function getAll(): array
    {
        return Cache::remember('users.all', 300, function () { // 5 minutes cache
            $response = $this->api->get('/admin/users');
            if (isset($response['error'])) {
                return [];
            }
            return $response['data'] ?? $response;
        });
    }

    public function create(array $data): array
    {
        $response = $this->api->post('/admin/users', $data);
        if (empty($response['error'])) {
            Cache::forget('users.all');
        }
        return $response;
    }

    public function update(string $id, array $data): array
    {
        $response = $this->api->put("/admin/users/{$id}", $data);
        if (empty($response['error'])) {
            Cache::forget('users.all');
        }
        return $response;
    }

    public function delete(string $id): array
    {
        $response = $this->api->delete("/admin/users/{$id}");
        if (empty($response['error'])) {
            Cache::forget('users.all');
        }
        return $response;
    }
}
