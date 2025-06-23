<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\ProductCategory;
use App\Models\Tag;
use App\Models\Topic;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    protected const PER_PAGE = 15;
    protected const FEATURED_LIMIT = 3;
    protected const RELATED_LIMIT = 3;
    protected const TOP_TAGS_LIMIT = 10;
    protected const TOP_TOPICS_LIMIT = 5;

    public function index(Request $request)
    {
        $tagSlug = $request->query('tag');
        $topicSlug = $request->query('topic');
        $categorySlug = $request->query('category');

        $postsQuery = Post::with(['tags', 'topics', 'productCategories', 'user'])
            ->published()
            ->latest('published_at');

        $this->applyFilters($postsQuery, $tagSlug, $topicSlug, $categorySlug);

        $posts = $postsQuery->paginate(self::PER_PAGE)->appends($request->query());

        $featuredPosts = $this->getFeaturedPosts();
        $topTags = $this->getTopTags();
        $topTopics = $this->getTopTopics();

        return view('pages.posts.index', [
            'posts' => $posts,
            'featuredPosts' => $featuredPosts,
            'topTags' => $topTags,
            'topTopics' => $topTopics,
            'currentTag' => $tagSlug ? $this->getTagBySlug($tagSlug) : null,
            'currentTopic' => $topicSlug ? $this->getTopicBySlug($topicSlug) : null,
            'currentCategory' => $categorySlug ? $this->getCategoryBySlug($categorySlug) : null,
        ]);
    }

    public function show(Post $post)
    {
        $relatedNews = $this->getRelatedPosts($post);

        return view('pages.posts.show', [
            'post' => $post,
            'relatedNews' => $relatedNews,
        ]);
    }

    protected function applyFilters($query, $tagSlug = null, $topicSlug = null, $categorySlug = null): void
    {
        if ($tagSlug) {
            $query->whereHas('tags', fn($q) => $q->where('slug', $tagSlug));
        }

        if ($topicSlug) {
            $query->whereHas('topics', fn($q) => $q->where('slug', $topicSlug));
        }

        if ($categorySlug) {
            $query->whereHas('productCategories', fn($q) => $q->where('slug', $categorySlug));
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

    protected function getRelatedPosts(Post $post)
    {
        $related = Post::published()
            ->where('id', '!=', $post->id)
            ->whereHas('tags', fn($q) => $q->whereIn('id', $post->tags->pluck('id')))
            ->inRandomOrder()
            ->limit(self::RELATED_LIMIT)
            ->get();

        $needed = self::RELATED_LIMIT - $related->count();

        if ($needed > 0) {
            $additional = Post::published()
                ->where('id', '!=', $post->id)
                ->whereNotIn('id', $related->pluck('id'))
                ->inRandomOrder()
                ->limit($needed)
                ->get();

            $related = $related->merge($additional);
        }

        return $related;
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
}
