<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AppearanceSettings extends Settings
{
    public array $sections;

    public static function group(): string
    {
        return 'appearance';
    }

    public static function defaults(): array
    {
        return [
            'sections' => [
                [
                    'name' => 'Homepage Hero Section',
                    'image' => null,
                    'description' => null,
                ],
                [
                    'name' => 'Performance Testing Section',
                    'image' => null,
                    'description' => null,
                ],
                [
                    'name' => 'Global Reach Section',
                    'image' => null,
                    'description' => null,
                ],
                [
                    'name' => 'News Header',
                    'image' => null,
                    'description' => null,
                ],
                [
                    'name' => 'Innovation Header',
                    'image' => null,
                    'description' => null,
                ],
                [
                    'name' => 'Product Header',
                    'image' => null,
                    'description' => null,
                ],
            ],
        ];
    }

    /**
     * Get a section by its name (case-insensitive).
     *
     * @param string $name
     * @return array|null
     */
    public function getSectionByName(string $name): ?array
    {
        foreach ($this->sections as $section) {
            if (strcasecmp($section['name'], $name) === 0) {
                return $section;
            }
        }

        return null;
    }
}
