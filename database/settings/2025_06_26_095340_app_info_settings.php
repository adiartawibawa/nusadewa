<?php

use App\Settings\AppInfoSettings;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $defaults = (new AppInfoSettings())->defaults();

        foreach ($defaults as $key => $value) {
            $this->migrator->add("app_info.{$key}", $value);
        }
    }
};
