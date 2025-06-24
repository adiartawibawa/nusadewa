<?php

namespace App\Livewire;

use App\Enums\PostType;
use App\Models\Post;
use Livewire\Component;

class TechnologiesSection extends Component
{
    public $posts;
    public $activeIndex = 0;
    public $autoRotate = false; // Changed to false since we're using scroll-snap

    public function mount()
    {
        $this->loadPosts();
    }

    public function loadPosts()
    {
        $this->posts = Post::published()
            ->ofType(PostType::TECHNOLOGY)
            ->orderBy('published_at', 'desc')
            ->limit(3) // Show 3 posts for this layout
            ->get()
            ->map(function ($post, $index) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'summary' => $post->summary,
                    'image' => $post->featured_image_url,
                    'index' => $index + 1,
                    'slug' => $post->slug
                ];
            });
    }

    public function render()
    {
        return view('livewire.technologies-section');
    }
}
