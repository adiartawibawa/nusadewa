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

    public $selectedTag = null;
    public $selectedTopic = null;
    public ?string $selectedCategory = null;
    public string $language;
    public string $postType = PostType::PRODUCT->value;
    public int $perPage = 12;
    public int $featuredCount = 3;

    protected $queryString = [
        'selectedCategory' => ['except' => ''],
    ];

    public function mount(?string $category = null)
    {
        $this->selectedCategory = $category;
        $this->language = app()->getLocale();
    }

    public function render()
    {
        // Featured Products
        $featuredProducts = Post::with('productCategories')
            ->where('type', $this->postType)
            ->published()
            ->where('is_featured', true)
            ->latest('published_at')
            ->take($this->featuredCount)
            ->get();

        $excludedIds = $featuredProducts->pluck('id')->toArray();

        // Products query
        $productsQuery = Post::with('productCategories')
            ->where('type', $this->postType)
            ->published()
            ->when(!empty($excludedIds), fn($q) => $q->whereNotIn('id', $excludedIds))
            ->when($this->selectedCategory, function ($query) {
                $query->whereHas('productCategories', function ($q) {
                    $q->where('slug', $this->selectedCategory)
                        ->orWhereHas('parent', fn($q) => $q->where('slug', $this->selectedCategory));
                });
            })
            ->latest('published_at');

        $products = $productsQuery->paginate($this->perPage);

        // Product Categories with counts
        $categories = ProductCategory::query()
            ->with([
                'children' => fn($query) => $query->withCount([
                    'posts' => fn($q) => $q->where('type', $this->postType)->published()
                ])
            ])
            ->mainCategories()
            ->withCount(['posts' => fn($q) => $q->where('type', $this->postType)->published()])
            ->orderBy('order')
            ->get();

        return view('livewire.products-section', [
            'featuredProducts' => $featuredProducts,
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function filterByCategory(?string $slug = null)
    {
        $this->resetPage();
        $this->selectedCategory = $slug;
    }

    public function resetFilters()
    {
        $this->resetPage();
        $this->selectedCategory = null;
    }

    public function filterByTag($slug)
    {
        $this->resetPage();
        $this->selectedTag = $slug;
        $this->selectedTopic = null;
        $this->selectedCategory = null;
    }

    public function filterByTopic($slug)
    {
        $this->resetPage();
        $this->selectedTopic = $slug;
        $this->selectedTag = null;
        $this->selectedCategory = null;
    }
}
