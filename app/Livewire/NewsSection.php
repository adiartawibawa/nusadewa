<?php

namespace App\Livewire;

use App\Enums\PostType;
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
    public $postType = 'news'; // Default type

    protected $queryString = [
        'selectedTag' => ['except' => ''],
        'selectedTopic' => ['except' => ''],
        'selectedCategory' => ['except' => ''],
    ];

    public function mount()
    {
        $this->language = app()->getLocale();
    }

    public function render()
    {
        // Daftar post type yang akan ditampilkan (exclude product dan technology)
        $allowedTypes = [
            PostType::ARTICLE->value,
            PostType::NEWS->value,
            PostType::PAGE->value,
        ];

        // Berita unggulan
        $featuredNews = Post::with(['tags', 'topics', 'productCategories'])
            ->whereIn('type', $allowedTypes)
            ->published()
            ->where('is_featured', true)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        $excludedIds = $featuredNews->pluck('id')->toArray();

        // Berita terbaru
        $latestQuery = Post::with(['tags', 'topics', 'productCategories'])
            ->whereIn('type', $allowedTypes)
            ->published()
            ->when(!empty($excludedIds), fn($q) => $q->whereNotIn('id', $excludedIds))
            ->when($this->selectedTag, fn($q) =>
            $q->whereHas('tags', fn($tag) => $tag->where('slug', $this->selectedTag)))
            ->when($this->selectedTopic, fn($q) =>
            $q->whereHas('topics', fn($topic) => $topic->where('slug', $this->selectedTopic)))
            ->when($this->selectedCategory, fn($q) =>
            $q->whereHas('productCategories', fn($cat) => $cat->where('slug', $this->selectedCategory)))
            ->orderByDesc('published_at');

        $latestNews = $latestQuery->paginate(6);

        // Top tags
        $topTags = Tag::withCount(['posts' => fn($q) => $q
            ->whereIn('type', $allowedTypes)
            ->published()])
            ->has('posts')
            ->orderByDesc('posts_count')
            ->take(10)
            ->get();

        // Top topics
        $topTopics = Topic::withCount(['posts' => fn($q) => $q
            ->whereIn('type', $allowedTypes)
            ->published()])
            ->has('posts')
            ->orderByDesc('posts_count')
            ->take(5)
            ->get();

        return view('livewire.news-section', [
            'featuredNews' => $featuredNews,
            'latestNews' => $latestNews,
            'topTags' => $topTags,
            'topTopics' => $topTopics,
        ]);
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

    public function filterByCategory($slug)
    {
        $this->resetPage();
        $this->selectedCategory = $slug;
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
