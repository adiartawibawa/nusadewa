<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;
use App\Models\View;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\Layout;
use App\Enums\PostType;

#[Layout('layouts.nusa-dewa-layout')]
class ProductShow extends Component
{
    protected const RELATED_LIMIT = 4; // Increased to 4 for better grid layout

    public Post $post;
    public $relatedProducts;

    public function mount(Post $post)
    {
        $this->post = $post->load([
            'views',
            'productCategories',
            'tags',
            'user'
        ])->loadCount('views');

        $this->relatedProducts = $this->getRelatedProducts($post);
        $this->recordView();
    }

    public function render()
    {
        return view('livewire.posts.product-show', [
            'post' => $this->post,
            'relatedProducts' => $this->relatedProducts,
        ]);
    }

    protected function getRelatedProducts(Post $post)
    {
        // First try to get products from same categories
        $related = Post::published()
            ->with(['productCategories', 'tags'])
            ->where('id', '!=', $post->id)
            ->where('type', PostType::PRODUCT)
            ->whereHas('productCategories', fn($q) => $q->whereIn('id', $post->productCategories->pluck('id')))
            ->inRandomOrder()
            ->limit(self::RELATED_LIMIT)
            ->get();

        // If not enough, fill with random products
        if ($related->count() < self::RELATED_LIMIT) {
            $additional = Post::published()
                ->with(['productCategories', 'tags'])
                ->where('id', '!=', $post->id)
                ->where('type', PostType::PRODUCT)
                ->whereNotIn('id', $related->pluck('id'))
                ->inRandomOrder()
                ->limit(self::RELATED_LIMIT - $related->count())
                ->get();

            $related = $related->merge($additional);
        }

        return $related;
    }

    protected function recordView()
    {
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
