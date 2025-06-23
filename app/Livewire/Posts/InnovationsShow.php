<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;
use App\Models\View;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\Layout;
use App\Enums\PostType;

#[Layout('layouts.nusa-dewa-layout')]
class InnovationsShow extends Component
{
    protected const RELATED_LIMIT = 3;

    public Post $innovation;
    public $relatedInnovations;

    public function mount(Post $post)
    {
        // Pastikan post adalah innovation
        if ($post->type !== PostType::INNOVATION) {
            abort(404);
        }

        $this->innovation = $post->loadCount('views')->load(['tags', 'topics', 'productCategories']);
        $this->relatedInnovations = $this->getRelatedInnovations($post);
        $this->recordView();
    }

    public function render()
    {
        return view('livewire.posts.innovations-show', [
            'innovation' => $this->innovation,
            'relatedInnovations' => $this->relatedInnovations,
        ]);
    }

    protected function getRelatedInnovations(Post $post)
    {
        $related = Post::where('type', PostType::INNOVATION)
            ->published()
            ->where('id', '!=', $post->id)
            ->whereHas('tags', fn($q) => $q->whereIn('id', $post->tags->pluck('id')))
            ->inRandomOrder()
            ->limit(self::RELATED_LIMIT)
            ->get();

        $needed = self::RELATED_LIMIT - $related->count();

        if ($needed > 0) {
            $additional = Post::where('type', PostType::INNOVATION)
                ->published()
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
        if (!session()->has('viewed_innovation_' . $this->innovation->id)) {
            View::create([
                'post_id' => $this->innovation->id,
                'ip' => Request::ip(),
                'agent' => Request::userAgent(),
                'referer' => Request::header('referer'),
                'country_code' => $this->getCountryCode(),
            ]);

            session()->put('viewed_innovation_' . $this->innovation->id, true);
        }
    }

    protected function getCountryCode()
    {
        try {
            $ip = Request::ip();
            if ($ip === '127.0.0.1') {
                return 'local';
            }

            $response = file_get_contents("http://ip-api.com/json/{$ip}?fields=countryCode");
            $data = json_decode($response, true);

            return $data['countryCode'] ?? 'unknown';
        } catch (\Exception $e) {
            return 'unknown';
        }
    }
}
