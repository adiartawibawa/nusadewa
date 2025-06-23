<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use App\Enums\PostType;
use App\Models\Tag;
use App\Models\Topic;
use Livewire\Attributes\Layout;

#[Layout('layouts.nusa-dewa-layout')]
class InnovationsIndex extends Component
{
    use WithPagination;

    public $selectedTag = null;
    public $selectedTopic = null;
    public $search = '';
    public $perPage = 9;

    protected $queryString = [
        'selectedTag' => ['except' => ''],
        'selectedTopic' => ['except' => ''],
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function filterByTag($tagSlug)
    {
        $this->selectedTag = $tagSlug;
        $this->resetPage();
    }

    public function filterByTopic($topicSlug)
    {
        $this->selectedTopic = $topicSlug;
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['selectedTag', 'selectedTopic', 'search']);
        $this->resetPage();
    }

    public function render()
    {
        $innovations = Post::with(['tags', 'topics', 'user'])
            ->where('type', PostType::INNOVATION)
            ->published()
            ->when($this->selectedTag, function ($query) {
                $query->whereHas('tags', function ($q) {
                    $q->where('slug', $this->selectedTag);
                });
            })
            ->when($this->selectedTopic, function ($query) {
                $query->whereHas('topics', function ($q) {
                    $q->where('slug', $this->selectedTopic);
                });
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('summary', 'like', '%' . $this->search . '%');
                });
            })
            ->orderByDesc('published_at')
            ->paginate($this->perPage);

        $featuredInnovations = Post::where('type', PostType::INNOVATION)
            ->published()
            ->where('is_featured', true)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        $tags = Tag::withCount(['posts' => function ($query) {
            $query->where('type', PostType::INNOVATION)->published();
        }])
            ->orderByDesc('posts_count')
            ->limit(12)
            ->get();

        $topics = Topic::withCount(['posts' => function ($query) {
            $query->where('type', PostType::INNOVATION)->published();
        }])
            ->orderByDesc('posts_count')
            ->limit(8)
            ->get();

        return view('livewire.posts.innovations-index', [
            'innovations' => $innovations,
            'featuredInnovations' => $featuredInnovations,
            'tags' => $tags,
            'topics' => $topics,
        ]);
    }
}
