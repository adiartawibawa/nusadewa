<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\ProductCategory;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsList extends Component
{
    use WithPagination;

    public $selectedCategory = null;
    public $language;

    protected $queryString = [
        'selectedCategory' => ['except' => '']
    ];

    public function mount()
    {
        $this->language = app()->getLocale();
    }

    public function render()
    {
        // Featured products (max 3)
        $featuredProducts = Post::with(['productCategories'])
            ->where('type', 'product')
            ->where('language', $this->language)
            ->where('is_featured', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        // Products query
        $query = Post::with(['productCategories'])
            ->where('type', 'product')
            ->where('language', $this->language)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->whereNotIn('id', $featuredProducts->pluck('id'));

        if ($this->selectedCategory) {
            $query->whereHas('productCategories', function ($q) {
                $q->where('slug', $this->selectedCategory);
            });
        }

        $products = $query->orderBy('published_at', 'desc')
            ->paginate(6);

        $categories = ProductCategory::withCount(['posts' => function ($query) {
            $query->where('type', 'product')
                ->where('language', app()->getLocale())
                ->whereNotNull('published_at')
                ->where('published_at', '<=', now());
        }])
            ->orderBy('posts_count', 'desc')
            ->get();

        return view('livewire.products-list', [
            'featuredProducts' => $featuredProducts,
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function filterByCategory($categorySlug)
    {
        $this->resetPage();
        $this->selectedCategory = $categorySlug;
    }

    public function resetFilters()
    {
        $this->resetPage();
        $this->selectedCategory = null;
    }
}
