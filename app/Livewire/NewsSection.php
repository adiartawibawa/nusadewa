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
    public $postType = 'news'; // Ganti jika konten kamu bertipe 'post' atau lainnya

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
        // Berita unggulan
        $featuredNews = Post::with(['tags', 'topics', 'productCategories'])
            // ->where('type', $this->postType)
            // ->where('language', $this->language)
            ->published()
            ->where('is_featured', true)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        $excludedIds = $featuredNews->pluck('id')->toArray();

        // Berita terbaru
        $latestQuery = Post::with(['tags', 'topics', 'productCategories'])
            // ->where('type', $this->postType)
            // ->where('language', $this->language)
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
            // ->where('type', $this->postType)
            // ->where('language', $this->language)
            ->published()])
            ->has('posts')
            ->orderByDesc('posts_count')
            ->take(10)
            ->get();

        // Top topics
        $topTopics = Topic::withCount(['posts' => fn($q) => $q
            // ->where('type', $this->postType)
            // ->where('language', $this->language)
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
