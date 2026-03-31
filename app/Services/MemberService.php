<?php

namespace App\Services;

use App\Clients\ApiClient;

class MemberService
{
    public function __construct(protected ApiClient $api)
    {
    }

    public function getAll(string $search = ''): array
    {
        $query = $search ? ['search' => $search] : [];
        $response = $this->api->get('/members', $query);

        if (isset($response['error'])) {
            return [];
        }

        // Return array of members directly or map to DTOs
        return $response['data'] ?? $response; 
    }

    public function getById(string $id): ?array
    {
        $response = $this->api->get("/members/{$id}");

        if (isset($response['error'])) {
            return null;
        }

        return $response['data'] ?? $response;
    }

    public function create(array $data): array
    {
        return $this->api->post('/members', $data);
    }
}
