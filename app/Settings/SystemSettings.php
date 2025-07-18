<?php

namespace App\Settings;

use Illuminate\Support\Facades\Cache;
use Spatie\LaravelSettings\Settings;

class SystemSettings extends Settings
{
    // General Settings
    public array $supported_languages;
    public ?string $default_language;
    public bool $maintenance_mode;
    public ?string $timezone;
    public ?string $date_format;
    public ?string $time_format;

    // SEO Settings
    public ?string $site_name;
    public ?string $site_description;
    public ?string $site_keywords;
    public ?string $site_author;
    public ?string $canonical_url;
    public ?string $robots_txt;
    public bool $enable_sitemap;
    public bool $enable_google_analytics;
    public ?string $google_analytics_id;
    public ?string $google_tag_manager_id;

    // Unsplash Settings
    public bool $unsplash_enabled;
    public ?string $unsplash_api_key;
    public array $unsplash_default_search_terms;
    public ?string $unsplash_image_quality;
    public bool $unsplash_auto_attribution;

    // Social Media Links
    public ?string $facebook_url;
    public ?string $twitter_url;
    public ?string $instagram_url;
    public ?string $linkedin_url;
    public ?string $youtube_url;

    public static function group(): string
    {
        return 'system';
    }

    public static function make(): static
    {
        return Cache::remember('system_settings', 3600, function () {
            return new static();
        });
    }

    // Method untuk clear cache saat settings di-update
    public static function clearCache(): void
    {
        Cache::forget('system_settings');
    }

    // Default values
    public static function defaults(): array
    {
        return [
            // General
            'supported_languages' => ['id', 'en'],
            'default_language' => 'id',
            'maintenance_mode' => false,
            'timezone' => 'Asia/Jakarta',
            'date_format' => 'd F Y',
            'time_format' => 'H:i',

            // SEO
            'site_name' => config('app.name'),
            'site_description' => '',
            'site_keywords' => '',
            'site_author' => '',
            'canonical_url' => config('app.url'),
            'robots_txt' => "User-agent: *\nDisallow: /admin\nAllow: /",
            'enable_sitemap' => true,
            'enable_google_analytics' => false,
            'google_analytics_id' => null,
            'google_tag_manager_id' => null,

            // Unsplash
            'unsplash_enabled' => false,
            'unsplash_api_key' => null,
            'unsplash_default_search_terms' => ['nature', 'business', 'technology'],
            'unsplash_image_quality' => 'regular', // raw, full, regular, small, thumb
            'unsplash_auto_attribution' => true,

            // Social Media
            'facebook_url' => 'https://www.facebook.com/BPIU2K/',
            'twitter_url' => 'https://x.com/bpiu2k_k',
            'instagram_url' => 'https://www.instagram.com/bpiu2k/',
            'linkedin_url' => null,
            'youtube_url' => 'http://www.youtube.com/@bpiu2kkarangasem939',
        ];
    }

    // Helper Methods
    public function isLanguageSupported(string $lang): bool
    {
        return in_array($lang, $this->supported_languages);
    }

    public function getUnsplashConfig(string $key, mixed $default = null): mixed
    {
        return data_get([
            'enabled' => $this->unsplash_enabled,
            'api_key' => $this->unsplash_api_key,
            'default_search_terms' => $this->unsplash_default_search_terms,
            'image_quality' => $this->unsplash_image_quality,
            'auto_attribution' => $this->unsplash_auto_attribution,
        ], $key, $default);
    }
}
