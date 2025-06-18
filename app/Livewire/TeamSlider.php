<?php

namespace App\Livewire;

use App\Models\TeamMember;
use Livewire\Component;

class TeamSlider extends Component
{
    public function getSocialIcon($platform)
    {
        if (empty($platform)) {
            return 'fas fa-link';
        }

        $icons = [
            'facebook' => 'fab fa-facebook-f',
            'twitter' => 'fab fa-twitter',
            'linkedin' => 'fab fa-linkedin-in',
            'instagram' => 'fab fa-instagram',
            'youtube' => 'fab fa-youtube',
            'github' => 'fab fa-github',
            'website' => 'fas fa-globe',
            'email' => 'fas fa-envelope',
        ];

        return $icons[strtolower($platform)] ?? 'fas fa-link';
    }

    public function render()
    {
        $teamMembers = TeamMember::active()
            ->ordered()
            ->get();

        return view('livewire.team-slider', [
            'teamMembers' => $teamMembers
        ]);
    }
}
