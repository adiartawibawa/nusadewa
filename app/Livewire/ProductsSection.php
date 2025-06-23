<?php

namespace App\Livewire;

use App\Enums\PostType;
use App\Models\Post;
use App\Models\ProductCategory;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsSection extends Component
{
    use WithPagination;

    public $selectedCategory = null;
    public $language;
    public $postType = PostType::PRODUCT->value;

    protected $queryString = [
        'selectedCategory' => ['except' => ''],
    ];

    public function mount()
    {
        $this->language = app()->getLocale();
    }

    public function render()
    {
        // Get main product categories with their children
        $categories = ProductCategory::with(['children' => function ($query) {
            $query->withCount(['posts' => fn($q) => $q->where('type', PostType::PRODUCT->value)]);
        }])
            ->mainCategories()
            ->withCount(['posts' => fn($q) => $q->where('type', PostType::PRODUCT->value)])
            ->orderBy('order')
            ->get();

        // Featured Products
        $featuredProducts = Post::with(['productCategories'])
            ->where('type', PostType::PRODUCT->value)
            ->published()
            ->where('is_featured', true)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        $excludedIds = $featuredProducts->pluck('id')->toArray();

        // Products Query
        $productsQuery = Post::with(['productCategories'])
            ->where('type', PostType::PRODUCT->value)
            ->published()
            ->when(!empty($excludedIds), fn($q) => $q->whereNotIn('id', $excludedIds))
            ->when($this->selectedCategory, function ($query) {
                $query->whereHas('productCategories', function ($q) {
                    $q->where('slug', $this->selectedCategory)
                        ->orWhereHas('parent', function ($q) {
                            $q->where('slug', $this->selectedCategory);
                        });
                });
            })
            ->orderByDesc('published_at');

        $products = $productsQuery->paginate(12);

        return view('livewire.products-section', [
            'featuredProducts' => $featuredProducts,
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function filterByCategory($slug)
    {
        $this->resetPage();
        $this->selectedCategory = $slug === $this->selectedCategory ? null : $slug;
    }

    public function resetFilters()
    {
        $this->resetPage();
        $this->selectedCategory = null;
    }
}
