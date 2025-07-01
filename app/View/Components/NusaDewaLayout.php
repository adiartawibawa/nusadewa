<?php

namespace App\View\Components;

use App\Settings\AppInfoSettings;
use App\Settings\SystemSettings;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class NusaDewaLayout extends Component
{

    public $appInfoSettings;
    public $systemSettings;

    /**
     * Create a new component instance.
     */
    public function __construct(AppInfoSettings $appInfoSettings, SystemSettings $systemSettings)
    {
        $this->appInfoSettings = $appInfoSettings;
        $this->systemSettings = $systemSettings;;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.nusa-dewa-layout', [
            'appInfo' => $this->getPublicAppInfo(),
            'systemInfo' => $this->getPublicSystemInfo(),
            'socialMedia' => $this->getSocialMediaInfo(),
            'seo' => $this->getSeoInfo(),
        ]);
    }

    /**
     * Get the public app information.
     *
     * @return array
     */
    public function getPublicAppInfo(): array
    {
        return [
            'company_name' => $this->appInfoSettings->company_name ?? 'Nusa Dewa',
            'company_description' => $this->appInfoSettings->company_description ?? 'As a leading vaname shrimp hatchery center in Bali, we provide biotechnology-based aquaculture solutions.',
            'address' => $this->appInfoSettings->address ?? 'Bugbug Road, Manggis District',
            'city' => $this->appInfoSettings->city ?? 'Karangasem',
            'province' => $this->appInfoSettings->province ?? 'Bali',
            'postal_code' => $this->appInfoSettings->postal_code ?? '80811',
            'country' => $this->appInfoSettings->country ?? 'Indonesia',
            'phone' => $this->appInfoSettings->phone ?? '03632787803',
            'email' => $this->appInfoSettings->email ?? 'bpiu2k@gmail.com',
            'companyLogo' => $this->getCompanyLogoUrl(),
            'operationalHours' => $this->appInfoSettings->operational_hours ?? [
                'monday' => ['07:30', '16:00'],
                'tuesday' => ['07:30', '16:00'],
                'wednesday' => ['07:30', '16:00'],
                'thursday' => ['07:30', '16:00'],
                'friday' => ['07:30', '16:30'],
                'saturday' => ['Closed', 'Closed'],
                'sunday' => ['Closed', 'Closed']
            ],
            'formattedHours' => $this->getFormattedOperationalHours(),
        ];
    }

    /**
     * Get the public system information.
     *
     * @return array
     */
    public function getPublicSystemInfo(): array
    {
        return [
            'supported_languages' => $this->systemSettings->supported_languages ?? ['id', 'en'],
            'default_language' => $this->systemSettings->default_language ?? 'id',
            'timezone' => $this->systemSettings->timezone ?? 'Asia/Jakarta',
            'date_format' => $this->systemSettings->date_format ?? 'd F Y',
            'time_format' => $this->systemSettings->time_format ?? 'H:i',
        ];
    }

    /**
     * Get the social media information.
     *
     * @return array
     */
    public function getSocialMediaInfo(): array
    {
        return [
            'social_media' => array_filter([
                'facebook' => $this->systemSettings->facebook_url,
                'twitter' => $this->systemSettings->twitter_url,
                'instagram' => $this->systemSettings->instagram_url,
                'linkedin' => $this->systemSettings->linkedin_url,
                'youtube' => $this->systemSettings->youtube_url
            ])
        ];
    }

    /**
     * Get the SEO's information.
     *
     * @return array
     */
    public function getSeoInfo(): array
    {
        return [
            'title' => $this->systemSettings->site_name ?? config('app.name'),
            'description' => $this->systemSettings->site_description ?? '',
            'keywords' => $this->systemSettings->site_keywords ?? '',
            'canonical_url' => $this->systemSettings->canonical_url ?? config('app.url'),
            'enable_google_analytics' => $this->systemSettings->enable_google_analytics ?? false,
            'google_analytics_id' => $this->systemSettings->google_analytics_id,
            'google_tag_manager_id' => $this->systemSettings->google_tag_manager_id
        ];
    }

    /**
     * Get the company logo url.
     *
     * @return array
     */
    public function getCompanyLogoUrl(): string
    {
        return !empty($this->appInfoSettings->company_logo)
            ? Storage::url($this->appInfoSettings->company_logo)
            : url('https://bpiu2k.online/img/logo.png');
    }

    /**
     * Get the formatted operational hours.
     *
     * @return array
     */
    public function getFormattedOperationalHours(): string
    {
        $hours = $this->appInfoSettings->operational_hours ?? [
            'monday' => ['07:30', '16:00'],
            'tuesday' => ['07:30', '16:00'],
            'wednesday' => ['07:30', '16:00'],
            'thursday' => ['07:30', '16:00'],
            'friday' => ['07:30', '16:30'],
            'saturday' => ['Closed', 'Closed'],
            'sunday' => ['Closed', 'Closed']
        ];

        $daysOrder = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $groupedHours = [];
        $currentGroup = null;

        foreach ($daysOrder as $day) {
            $time = $hours[$day] ?? ['Closed', 'Closed'];
            $timeStr = ($time[0] === 'Closed')
                ? 'Closed'
                : date('g:iA', strtotime($time[0])) . ' - ' . date('g:iA', strtotime($time[1]));

            if (!$currentGroup) {
                $currentGroup = [
                    'startDay' => $day,
                    'endDay' => $day,
                    'time' => $timeStr
                ];
            } elseif ($currentGroup['time'] === $timeStr) {
                $currentGroup['endDay'] = $day;
            } else {
                $groupedHours[] = $currentGroup;
                $currentGroup = [
                    'startDay' => $day,
                    'endDay' => $day,
                    'time' => $timeStr
                ];
            }
        }

        if ($currentGroup) {
            $groupedHours[] = $currentGroup;
        }

        $formatted = array_map(function ($group) {
            $startDay = ucfirst($group['startDay']);
            $endDay = ucfirst($group['endDay']);

            if ($group['startDay'] === $group['endDay']) {
                return "$startDay: {$group['time']}";
            }
            return "$startDay - $endDay: {$group['time']}";
        }, $groupedHours);

        return implode('<br>', $formatted);
    }
}
