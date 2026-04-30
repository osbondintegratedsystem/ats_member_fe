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
        $query = ['search' => $search ?: 'all'];
        $response = $this->api->get('/member/list', $query);

        if (isset($response['error']) || ($response['isSuccess'] ?? false) === false) {
            return [];
        }

        return $response['members'] ?? [];
    }

    public function getById(string $id): ?array
    {
        // API doesn't have a specific get_by_id endpoint, use search
        $response = $this->api->get("/member/list", ['search' => $id]);

        if (isset($response['error']) || ($response['isSuccess'] ?? false) === false) {
            return null;
        }

        $items = $response['members'] ?? [];
        return is_array($items) && count($items) > 0 ? $items[0] : null;
    }

    public function create(array $data): array
    {
        return $this->api->post('/member/add', [
            'id' => $data['id'] ?? '',
            'name' => $data['name'] ?? '',
            'last_package' => $data['package'] ?? '',
            'exp' => $data['expiration_date'] ?? '',
            'pp_link' => $data['pp_link'] ?? '',
            'hp' => $data['phone'] ?? ''
        ]);
    }
}
