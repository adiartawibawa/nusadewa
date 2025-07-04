<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ApiSettings extends Settings
{
    public array $api_configurations;

    public static function group(): string
    {
        return 'api';
    }

    public static function defaults(): array
    {
        return [
            'api_configurations' => [
                'order' => [
                    'name' => 'Order',
                    'url' => 'https://bpiu2k.online/api/orderND',
                    'method' => 'GET',
                    'auth_type' => 'none',
                    'auth_credentials' => null,
                    'api_key' => null,
                    'headers' => [],
                    'timeout' => 30,
                    'verify_ssl' => true,
                    'active' => true,
                    'last_sync' => null,
                    'last_status' => null,
                    'last_message' => null,
                    'last_checked' => null
                ]
            ]
        ];
    }

    public function getApiConfig(string $apiName): ?array
    {
        return $this->api_configurations[$apiName] ?? null;
    }

    public function getPreparedHeaders(string $apiName): array
    {
        $config = $this->getApiConfig($apiName);
        if (!$config) return [];

        $headers = $config['headers'] ?? [];

        if ($config['auth_type'] === 'bearer' && $config['auth_credentials']) {
            $headers['Authorization'] = 'Bearer ' . $config['auth_credentials'];
        } elseif ($config['auth_type'] === 'basic' && $config['auth_credentials']) {
            $headers['Authorization'] = 'Basic ' . base64_encode($config['auth_credentials']);
        }

        if ($config['api_key']) {
            $headers['X-API-KEY'] = $config['api_key'];
        }

        return $headers;
    }
}
