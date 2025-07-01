<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class EmailSettings extends Settings
{
    public string $from_address;
    public string $from_name;
    public string $mailer;
    public string $host;
    public int $port;
    public string $username;
    public string $password;
    public ?string $encryption;
    public ?string $test_address;

    public static function group(): string
    {
        return 'email';
    }

    public static function defaults(): array
    {
        return [
            'from_address' => env('MAIL_FROM_ADDRESS', 'noreply@example.com'),
            'from_name' => env('MAIL_FROM_NAME', env('APP_NAME', 'Nusa Dewa')),
            'mailer' => env('MAIL_MAILER', 'smtp'),
            'host' => env('MAIL_HOST', 'sandbox.smtp.mailtrap.io'),
            'port' => env('MAIL_PORT', 2525),
            'username' => env('MAIL_USERNAME', ''),
            'password' => env('MAIL_PASSWORD', ''),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'test_address' => env('MAIL_TEST_ADDRESS', 'test@example.com'),
        ];
    }
    public function toMailConfig(): array
    {
        return [
            'default' => $this->mailer,
            'from' => [
                'address' => $this->from_address,
                'name' => $this->from_name,
            ],
            'mailers' => [
                $this->mailer => array_filter([
                    'transport' => $this->mailer,
                    'host' => $this->host,
                    'port' => $this->port,
                    'encryption' => $this->encryption,
                    'username' => $this->username,
                    'password' => $this->password,
                    'timeout' => null,
                    'auth_mode' => null,
                ])
            ],
        ];
    }
}
