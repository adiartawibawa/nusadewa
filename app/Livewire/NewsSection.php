<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Topic;
use Livewire\Component;
use Livewire\WithPagination;

class NewsSection extends Component
{
    use WithPagination;

    public $selectedTag = null;
    public $selectedTopic = null;
    public $selectedCategory = null;
    public $language;

    protected $queryString = [
        'selectedTag' => ['except' => ''],
        'selectedTopic' => ['except' => ''],
        'selectedCategory' => ['except' => '']
    ];

    public function mount()
    {
        $this->language = app()->getLocale();
    }

    public function render()
    {
        // Query berita utama (featured)
        $featuredQuery = Post::with(['tags', 'topics', 'productCategories'])
            ->where('type', 'post')
            ->where('language', $this->language)
            ->where('is_featured', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->take(3);

        $featuredNews = $featuredQuery->get();
        $featuredIds = $featuredNews->pluck('id')->toArray();

        // Query berita terbaru
        $latestQuery = Post::with(['tags', 'topics', 'productCategories'])
            ->where('type', 'post')
            ->where('language', $this->language)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());

        // Exclude featured posts
        if (!empty($featuredIds)) {
            $latestQuery->whereNotIn('id', $featuredIds);
        }

        // Filter berdasarkan tag
        if ($this->selectedTag) {
            $latestQuery->whereHas('tags', function ($q) {
                $q->where('slug', $this->selectedTag);
            });
        }

        // Filter berdasarkan topik
        if ($this->selectedTopic) {
            $latestQuery->whereHas('topics', function ($q) {
                $q->where('slug', $this->selectedTopic);
            });
        }

        // Filter berdasarkan kategori produk
        if ($this->selectedCategory) {
            $latestQuery->whereHas('productCategories', function ($q) {
                $q->where('slug', $this->selectedCategory);
            });
        }

        $latestNews = $latestQuery->orderBy('published_at', 'desc')
            ->paginate(6);

        // Top tags
        $topTags = Tag::withCount(['posts' => function ($query) {
            $query->where('type', 'news')
                ->where('language', $this->language)
                ->whereNotNull('published_at')
                ->where('published_at', '<=', now());
        }])
            ->orderBy('posts_count', 'desc')
            ->take(10)
            ->get();

        // Top topics
        $topTopics = Topic::withCount(['posts' => function ($query) {
            $query->where('type', 'news')
                ->where('language', $this->language)
                ->whereNotNull('published_at')
                ->where('published_at', '<=', now());
        }])
            ->orderBy('posts_count', 'desc')
            ->take(5)
            ->get();

        return view('livewire.news-section', [
            'featuredNews' => $featuredNews,
            'latestNews' => $latestNews,
            'topTags' => $topTags,
            'topTopics' => $topTopics,
        ]);
    }

    public function filterByTag($tagSlug)
    {
        $this->resetPage();
        $this->selectedTag = $tagSlug;
        $this->selectedTopic = null;
        $this->selectedCategory = null;
    }

    public function filterByTopic($topicSlug)
    {
        $this->resetPage();
        $this->selectedTopic = $topicSlug;
        $this->selectedTag = null;
        $this->selectedCategory = null;
    }

    public function filterByCategory($categorySlug)
    {
        $this->resetPage();
        $this->selectedCategory = $categorySlug;
        $this->selectedTag = null;
        $this->selectedTopic = null;
    }

    public function resetFilters()
    {
        $this->resetPage();
        $this->selectedTag = null;
        $this->selectedTopic = null;
        $this->selectedCategory = null;
    }
}
