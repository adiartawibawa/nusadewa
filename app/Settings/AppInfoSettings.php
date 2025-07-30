<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AppInfoSettings extends Settings
{
    public ?string $company_name;
    public ?string $company_description;
    public ?string $company_logo;
    public ?string $address;
    public ?string $email;
    public ?string $city;
    public ?string $province;
    public ?string $postal_code;
    public ?string $country;
    public ?string $phone;
    public array $operational_hours;

    public static function group(): string
    {
        return 'app_info';
    }

    public static function defaults(): array
    {
        return [
            'company_name' => 'Nusa Dewa',
            'company_description' => 'Sebagai pusat pembenihan udang vaname terkemuka di Bali, kami siap membantu Anda dengan solusi akuakultur berbasis bioteknologi.',
            'company_logo' => '',
            'address' => 'Jalan Raya Bugbug, Kec. Manggis',
            'email' => 'bpiu2k@gmail.com',
            'city' => 'Karangasem',
            'province' => 'Bali',
            'postal_code' => '80811',
            'country' => 'Indonesia',
            'phone' => '03632787803',
            'operational_hours' => [
                'monday' => ['08:00', '17:00'],
                'tuesday' => ['08:00', '17:00'],
                'wednesday' => ['08:00', '17:00'],
                'thursday' => ['08:00', '17:00'],
                'friday' => ['08:00', '17:00'],
                'saturday' => ['09:00', '15:00'],
                'sunday' => ['Closed', 'Closed'],
            ],
        ];
    }

    public function getFormattedOperationalHours(): string
    {
        $formatted = [];

        foreach ($this->operational_hours as $day => $hours) {
            $formattedDay = ucfirst($day);
            $formattedHours = ($hours[0] === 'Closed') ? 'Closed' : "{$hours[0]} - {$hours[1]}";
            $formatted[] = "{$formattedDay}: {$formattedHours}";
        }

        return implode('<br>', $formatted);
    }
}
