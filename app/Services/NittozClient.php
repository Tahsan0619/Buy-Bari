<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class NittozClient
{
    public function configured(): bool
    {
        foreach (['app_key', 'app_secret', 'username'] as $key) {
            $value = trim((string) config('nittoz.'.$key));
            if ($value === '' || str_starts_with($value, 'paste-your')) {
                return false;
            }
        }

        return true;
    }

    public function missingMessage(): string
    {
        return 'Nittoz order credentials are not set yet. Paste NITTOZ_APP_KEY, NITTOZ_APP_SECRET and NITTOZ_USERNAME into the .env file to transfer orders. Product sync works without those keys.';
    }

    public function products(array $query = []): array
    {
        return $this->send('GET', $this->base().'/products', [], $query, false);
    }

    public function categories(): array
    {
        return $this->send('GET', $this->base().'/categories', [], [], false);
    }

    public function product(int|string $id): array
    {
        return $this->send('GET', $this->base().'/products/'.$id, [], [], false);
    }

    public function createOrder(array $payload): array
    {
        return $this->send('POST', (string) config('nittoz.order_url'), $payload, [], true);
    }

    private function base(): string
    {
        return rtrim((string) config('nittoz.base_url'), '/');
    }

    /**
     * @param  array<string, mixed>  $payload
     * @param  array<string, mixed>  $query
     * @return array<string, mixed>
     */
    private function send(string $method, string $url, array $payload = [], array $query = [], bool $auth = false): array
    {
        if ($auth && ! $this->configured()) {
            throw new RuntimeException($this->missingMessage());
        }

        $attempts = 0;
        $maxAttempts = $method === 'GET' ? 6 : 1;

        while (true) {
            $attempts++;
            $pending = $this->http($auth);

            /** @var Response $response */
            $response = $method === 'POST'
                ? $pending->post($url, $payload)
                : $pending->get($url, $query);

            $json = $response->json();
            if (! is_array($json)) {
                $json = ['message' => $response->body()];
            }

            $message = $json['message'] ?? ('Nittoz request failed with status '.$response->status());
            $messageText = is_string($message) ? $message : 'Nittoz request failed.';
            $rateLimited = $response->status() === 429
                || str_contains(strtolower($messageText), 'too many attempts')
                || str_contains(strtolower($messageText), 'too many requests');

            $failed = ! $response->successful()
                || ($json['success'] ?? null) === false
                || ($json['status'] ?? null) === 'error'
                || ($json['status'] ?? null) === false;

            if (! $failed) {
                return $json;
            }

            if ($rateLimited && $attempts < $maxAttempts) {
                usleep(min(30_000_000, (2 ** $attempts) * 500_000));

                continue;
            }

            throw new RuntimeException($messageText);
        }
    }

    private function http(bool $auth): PendingRequest
    {
        $headers = ['Accept' => 'application/json'];
        if ($auth) {
            $headers['App-Key'] = (string) config('nittoz.app_key');
            $headers['App-Secret'] = (string) config('nittoz.app_secret');
            $headers['Username'] = (string) config('nittoz.username');
        }

        return Http::withHeaders($headers)->connectTimeout(10)->timeout(60)->acceptJson();
    }
}
