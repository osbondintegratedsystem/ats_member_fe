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
            $response = $this->api->get('/user/list', ['search' => 'all']);
            if (isset($response['error']) || ($response['isSuccess'] ?? false) === false) {
                return [];
            }
            return $response['users'] ?? [];
        });
    }

    public function create(array $data): array
    {
        $response = $this->api->post('/user/add', [
            'id' => $data['username'] ?? $data['id'] ?? '',
            'name' => $data['name'] ?? '',
            'pass' => $data['password'] ?? 'default123',
            'level' => $data['role'] === 'Administrator' ? 1 : 6 // Dummy map role to level
        ]);
        if (empty($response['error'])) {
            Cache::forget('users.all');
        }
        return $response;
    }

    public function update(string $id, array $data): array
    {
        $response = $this->api->post("/user/edit", [
            'id' => $id,
            'name' => $data['name'] ?? '',
            'pass' => $data['password'] ?? 'default123',
            'level' => ($data['role'] ?? '') === 'Administrator' ? 1 : 6
        ]);
        if (empty($response['error'])) {
            Cache::forget('users.all');
        }
        return $response;
    }

    public function delete(string $id): array
    {
        $response = $this->api->post("/user/delete", ['id' => $id]);
        if (empty($response['error'])) {
            Cache::forget('users.all');
        }
        return $response;
    }
}
