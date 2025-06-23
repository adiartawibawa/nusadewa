<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;
use App\Models\View;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\Layout;

#[Layout('layouts.nusa-dewa-layout')]
class PostsShow extends Component
{
    protected const RELATED_LIMIT = 3;

    public Post $post;
    public $relatedNews;

    public function mount(Post $post)
    {
        $this->post = $post->loadCount('views');
        $this->relatedNews = $this->getRelatedPosts($post);
        $this->recordView();
    }

    public function render()
    {
        return view('livewire.posts.show', [
            'post' => $this->post,
            'relatedNews' => $this->relatedNews,
        ]);
    }

    protected function getRelatedPosts(Post $post)
    {
        $related = Post::published()
            ->where('id', '!=', $post->id)
            ->whereHas('tags', fn($q) => $q->whereIn('id', $post->tags->pluck('id')))
            ->inRandomOrder()
            ->limit(self::RELATED_LIMIT)
            ->get();

        $needed = self::RELATED_LIMIT - $related->count();

        if ($needed > 0) {
            $additional = Post::published()
                ->where('id', '!=', $post->id)
                ->whereNotIn('id', $related->pluck('id'))
                ->inRandomOrder()
                ->limit($needed)
                ->get();

            $related = $related->merge($additional);
        }

        return $related;
    }

    protected function recordView()
    {
        // Cek apakah view sudah tercatat dalam session untuk menghindari duplikasi
        if (!session()->has('viewed_post_' . $this->post->id)) {
            View::create([
                'post_id' => $this->post->id,
                'ip' => Request::ip(),
                'agent' => Request::userAgent(),
                'referer' => Request::header('referer'),
                'country_code' => $this->getCountryCode(),
            ]);

            session()->put('viewed_post_' . $this->post->id, true);
        }
    }

    protected function getCountryCode()
    {
        // Menggunakan IP geolocation
        try {
            $ip = Request::ip();
            if ($ip === '127.0.0.1') {
                return 'local';
            }

            // Menggunakan service ip-api.com (gratis)
            $response = file_get_contents("http://ip-api.com/json/{$ip}?fields=countryCode");
            $data = json_decode($response, true);

            return $data['countryCode'] ?? 'unknown';
        } catch (\Exception $e) {
            return 'unknown';
        }
    }
}
