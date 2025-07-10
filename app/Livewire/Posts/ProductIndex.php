<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use App\Models\ProductCategory;
use App\Enums\PostType;
use Livewire\Attributes\Layout;

#[Layout('layouts.nusa-dewa-layout')]
class ProductIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategories = [];
    public $sortField = 'published_at';
    public $sortDirection = 'desc';
    public $perPage = 12;

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategories' => ['except' => []],
        'sortField' => ['except' => 'published_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function mount()
    {
        // Initialize with all categories selected if needed
        // $this->selectedCategories = ProductCategory::pluck('id')->toArray();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function resetFilters()
    {
        $this->reset(['search', 'selectedCategories']);
        $this->resetPage();
    }

    public function updatedSelectedCategories()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function removeCategoryFilter($categoryId)
    {
        $this->selectedCategories = array_filter(
            $this->selectedCategories,
            fn($id) => $id != $categoryId
        );
        $this->resetPage();
    }

    public function render()
    {
        $products = Post::published()
            ->with(['productCategories', 'user'])
            ->where('type', PostType::PRODUCT)
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('summary', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->selectedCategories, function ($query) {
                $query->whereHas('productCategories', function ($q) {
                    $q->whereIn('id', $this->selectedCategories);
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $categories = ProductCategory::orderBy('name')->get();

        return view('livewire.posts.product-index', [
            'products' => $products,
            'categories' => $categories,
            'sortField' => $this->sortField,
            'sortDirection' => $this->sortDirection,
        ]);
    }
}
