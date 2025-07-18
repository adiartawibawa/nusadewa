<?php

use App\Settings\SystemSettings;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $defaults = SystemSettings::defaults();

        foreach ($defaults as $key => $value) {
            $this->migrator->add("system.{$key}", $value);
        }
    }
};
