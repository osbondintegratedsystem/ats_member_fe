<?php

namespace App\Services;

use App\Clients\ApiClient;
use Illuminate\Support\Facades\Session;

class AuthService
{
    public function __construct(protected ApiClient $api)
    {
    }

    public function login(string $username, string $password): array
    {
        $response = $this->api->post('/auth/login', [
            'username' => $username,
            'password' => $password,
        ]);

        if (empty($response['error']) && isset($response['token'])) {
            Session::put('api_token', $response['token']);
            Session::put('user', $response['user'] ?? ['name' => $username]);
            return ['success' => true];
        }

        return ['success' => false, 'message' => $response['message'] ?? 'Login failed.'];
    }

    public function logout(): void
    {
        Session::forget('api_token');
        Session::forget('user');
        // Optional: call API logout endpoint
        // $this->api->post('/auth/logout');
    }
}
