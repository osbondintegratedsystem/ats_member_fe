<?php

namespace App\Clients;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\PendingRequest;

class ApiClient
{
    protected string $baseUrl;
    protected int $timeout;
    protected ?string $token = null;

    public function __construct()
    {
        $this->baseUrl = config('api.base_url');
        $this->timeout = config('api.timeout');
        $this->token = session('api_token');
    }

    protected function request(): PendingRequest
    {
        $request = Http::baseUrl($this->baseUrl)
            ->timeout($this->timeout)
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ]);

        // If your API uses an API key header
        if ($apiKey = config('api.api_key')) {
             $request->withHeaders(['X-Api-Key' => $apiKey]);
        }

        // Add Bearer Token if available in session
        if ($this->token) {
            $request->withToken($this->token);
        }

        return $request->retry(2, 100); // Retry twice with 100ms delay
    }

    public function get(string $endpoint, array $query = [])
    {
        try {
            $response = $this->request()->get($endpoint, $query);
            return $this->handleResponse($response, 'GET ' . $endpoint);
        } catch (\Exception $e) {
            return $this->handleException($e, 'GET ' . $endpoint);
        }
    }

    public function post(string $endpoint, array $data = [])
    {
        try {
            $response = $this->request()->post($endpoint, $data);
            return $this->handleResponse($response, 'POST ' . $endpoint);
        } catch (\Exception $e) {
            return $this->handleException($e, 'POST ' . $endpoint);
        }
    }

    public function put(string $endpoint, array $data = [])
    {
        try {
            $response = $this->request()->put($endpoint, $data);
            return $this->handleResponse($response, 'PUT ' . $endpoint);
        } catch (\Exception $e) {
            return $this->handleException($e, 'PUT ' . $endpoint);
        }
    }

    public function delete(string $endpoint)
    {
        try {
            $response = $this->request()->delete($endpoint);
            return $this->handleResponse($response, 'DELETE ' . $endpoint);
        } catch (\Exception $e) {
            return $this->handleException($e, 'DELETE ' . $endpoint);
        }
    }

    protected function handleResponse($response, string $context)
    {
        if ($response->successful()) {
            return $response->json();
        }

        Log::error("API Request Failed [{$context}]", [
            'status' => $response->status(),
            'body' => $response->body()
        ]);

        return ['error' => true, 'message' => 'API Request failed: ' . $response->status()];
    }

    protected function handleException(\Exception $e, string $context)
    {
        Log::error("API Request Exception [{$context}]", [
            'message' => $e->getMessage()
        ]);

        return ['error' => true, 'message' => 'Communication error: ' . $e->getMessage()];
    }
}
