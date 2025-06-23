<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use App\Models\ProductCategory;
use App\Models\Tag;
use App\Models\Topic;
use Livewire\Attributes\Layout;

#[Layout('layouts.nusa-dewa-layout')]
class PostsIndex extends Component
{
    use WithPagination;

    protected const PER_PAGE = 15;
    protected const FEATURED_LIMIT = 3;
    protected const TOP_TAGS_LIMIT = 10;
    protected const TOP_TOPICS_LIMIT = 5;

    public $tagSlug;
    public $topicSlug;
    public $categorySlug;
    public $currentTag;
    public $currentTopic;
    public $currentCategory;

    public function mount()
    {
        $this->tagSlug = request()->query('tag');
        $this->topicSlug = request()->query('topic');
        $this->categorySlug = request()->query('category');

        if ($this->tagSlug) {
            $this->currentTag = $this->getTagBySlug($this->tagSlug);
        }

        if ($this->topicSlug) {
            $this->currentTopic = $this->getTopicBySlug($this->topicSlug);
        }

        if ($this->categorySlug) {
            $this->currentCategory = $this->getCategoryBySlug($this->categorySlug);
        }
    }

    public function render()
    {
        $posts = $this->getPosts();
        $featuredPosts = $this->getFeaturedPosts();
        $topTags = $this->getTopTags();
        $topTopics = $this->getTopTopics();

        return view('livewire.posts.index', [
            'posts' => $posts,
            'featuredPosts' => $featuredPosts,
            'topTags' => $topTags,
            'topTopics' => $topTopics,
        ]);
    }

    protected function getPosts()
    {
        $query = Post::with(['tags', 'topics', 'productCategories', 'user'])
            ->published()
            ->latest('published_at');

        $this->applyFilters($query);

        return $query->paginate(self::PER_PAGE);
    }

    protected function applyFilters($query): void
    {
        if ($this->tagSlug) {
            $query->whereHas('tags', fn($q) => $q->where('slug', $this->tagSlug));
        }

        if ($this->topicSlug) {
            $query->whereHas('topics', fn($q) => $q->where('slug', $this->topicSlug));
        }

        if ($this->categorySlug) {
            $query->whereHas('productCategories', fn($q) => $q->where('slug', $this->categorySlug));
        }
    }

    protected function getFeaturedPosts()
    {
        return Post::with(['tags', 'topics'])
            ->published()
            ->featured()
            ->latest('published_at')
            ->limit(self::FEATURED_LIMIT)
            ->get();
    }

    protected function getTopTags()
    {
        return Tag::withCount(['posts' => fn($q) => $q->published()])
            ->orderByDesc('posts_count')
            ->limit(self::TOP_TAGS_LIMIT)
            ->get();
    }

    protected function getTopTopics()
    {
        return Topic::withCount(['posts' => fn($q) => $q->published()])
            ->orderByDesc('posts_count')
            ->limit(self::TOP_TOPICS_LIMIT)
            ->get();
    }

    protected function getTagBySlug($slug)
    {
        return Tag::firstWhere('slug', $slug);
    }

    protected function getTopicBySlug($slug)
    {
        return Topic::firstWhere('slug', $slug);
    }

    protected function getCategoryBySlug($slug)
    {
        return ProductCategory::firstWhere('slug', $slug);
    }

    public function clearFilter($type)
    {
        switch ($type) {
            case 'tag':
                $this->tagSlug = null;
                $this->currentTag = null;
                break;
            case 'topic':
                $this->topicSlug = null;
                $this->currentTopic = null;
                break;
            case 'category':
                $this->categorySlug = null;
                $this->currentCategory = null;
                break;
        }
    }
}
