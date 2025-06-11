<?php

use App\Settings\SystemSettings;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('system.supported_languages', SystemSettings::defaults()['supported_languages']);
        $this->migrator->add('system.default_language', SystemSettings::defaults()['default_language']);
        $this->migrator->add('system.maintenance_mode', SystemSettings::defaults()['maintenance_mode']);
        $this->migrator->add('system.timezone', SystemSettings::defaults()['timezone']);
        $this->migrator->add('system.date_format', SystemSettings::defaults()['date_format']);
        $this->migrator->add('system.time_format', SystemSettings::defaults()['time_format']);

        // SEO Settings
        $this->migrator->add('system.site_name', SystemSettings::defaults()['site_name']);
        $this->migrator->add('system.site_description', SystemSettings::defaults()['site_description']);
        $this->migrator->add('system.site_keywords', SystemSettings::defaults()['site_keywords']);
        $this->migrator->add('system.site_author', SystemSettings::defaults()['site_author']);
        $this->migrator->add('system.canonical_url', SystemSettings::defaults()['canonical_url']);
        $this->migrator->add('system.robots_txt', SystemSettings::defaults()['robots_txt']);
        $this->migrator->add('system.enable_sitemap', SystemSettings::defaults()['enable_sitemap']);
        $this->migrator->add('system.enable_google_analytics', SystemSettings::defaults()['enable_google_analytics']);
        $this->migrator->add('system.google_analytics_id', SystemSettings::defaults()['google_analytics_id']);
        $this->migrator->add('system.google_tag_manager_id', SystemSettings::defaults()['google_tag_manager_id']);

        // Unsplash Settings
        $this->migrator->add('system.unsplash_enabled', SystemSettings::defaults()['unsplash_enabled']);
        $this->migrator->add('system.unsplash_api_key', SystemSettings::defaults()['unsplash_api_key']);
        $this->migrator->add('system.unsplash_default_search_terms', SystemSettings::defaults()['unsplash_default_search_terms']);
        $this->migrator->add('system.unsplash_image_quality', SystemSettings::defaults()['unsplash_image_quality']);
        $this->migrator->add('system.unsplash_auto_attribution', SystemSettings::defaults()['unsplash_auto_attribution']);

        // Landing Page Settings
        $this->migrator->add('system.landing_page_sections', SystemSettings::defaults()['landing_page_sections']);
        $this->migrator->add('system.landing_primary_color', SystemSettings::defaults()['landing_primary_color']);
        $this->migrator->add('system.landing_secondary_color', SystemSettings::defaults()['landing_secondary_color']);
        $this->migrator->add('system.landing_show_testimonials', SystemSettings::defaults()['landing_show_testimonials']);
        $this->migrator->add('system.landing_show_featured_products', SystemSettings::defaults()['landing_show_featured_products']);

        // Product Settings
        $this->migrator->add('system.product_currency', SystemSettings::defaults()['product_currency']);
        $this->migrator->add('system.product_currency_symbol', SystemSettings::defaults()['product_currency_symbol']);
        $this->migrator->add('system.product_show_prices', SystemSettings::defaults()['product_show_prices']);
        $this->migrator->add('system.product_enable_reviews', SystemSettings::defaults()['product_enable_reviews']);
        $this->migrator->add('system.product_enable_stock_management', SystemSettings::defaults()['product_enable_stock_management']);

        // Team Settings
        $this->migrator->add('system.team_enabled', SystemSettings::defaults()['team_enabled']);
        $this->migrator->add('system.team_layout', SystemSettings::defaults()['team_layout']);
        $this->migrator->add('system.team_show_social_links', SystemSettings::defaults()['team_show_social_links']);
        $this->migrator->add('system.team_social_platforms', SystemSettings::defaults()['team_social_platforms']);

        // Social Media Links
        $this->migrator->add('system.facebook_url', SystemSettings::defaults()['facebook_url']);
        $this->migrator->add('system.twitter_url', SystemSettings::defaults()['twitter_url']);
        $this->migrator->add('system.instagram_url', SystemSettings::defaults()['instagram_url']);
        $this->migrator->add('system.linkedin_url', SystemSettings::defaults()['linkedin_url']);
        $this->migrator->add('system.youtube_url', SystemSettings::defaults()['youtube_url']);
    }
};
