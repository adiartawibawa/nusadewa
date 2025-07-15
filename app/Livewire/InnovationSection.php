<?php

namespace App\Livewire;

use App\Enums\PostType;
use App\Models\Post;
use Livewire\Component;

class InnovationSection extends Component
{
    public $innovations = [];

    public bool $useAccordion = false;

    public function mount()
    {
        $this->innovations = Post::where('type', PostType::INNOVATION->value)
            ->published()
            ->orderByDesc('published_at')
            ->take(10)
            ->get()
            ->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->getTranslation('title', app()->getLocale()),
                    'summary' => $post->getTranslation('summary', app()->getLocale()),
                    'image' => $post->featured_image,
                    'slug' => $post->slug,
                ];
            })
            ->toArray();

        $this->useAccordion = count($this->innovations) <= 3;
    }

    public function render()
    {
        return view('livewire.innovation-section');
    }
}
