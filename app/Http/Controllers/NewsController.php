<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Topic;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $tag = $request->query('tag');
        $topic = $request->query('topic');

        $query = Post::with(['tags', 'topics', 'productCategories', 'user'])
            ->published()
            ->ofType('news')
            ->where('language', app()->getLocale())
            ->orderBy('published_at', 'desc');

        if ($tag) {
            $query->whereHas('tags', function ($q) use ($tag) {
                $q->where('slug', $tag);
            });
        }

        if ($topic) {
            $query->whereHas('topics', function ($q) use ($topic) {
                $q->where('slug', $topic);
            });
        }

        $posts = $query->paginate(9);
        $featuredPosts = Post::published()->ofType('news')->featured()->take(3)->get();
        $topTags = Tag::withCount('posts')->orderBy('posts_count', 'desc')->take(10)->get();
        $topTopics = Topic::withCount('posts')->orderBy('posts_count', 'desc')->take(5)->get();

        return view('news.index', [
            'posts' => $posts,
            'featuredPosts' => $featuredPosts,
            'topTags' => $topTags,
            'topTopics' => $topTopics,
            'currentTag' => $tag ? Tag::where('slug', $tag)->first() : null,
            'currentTopic' => $topic ? Topic::where('slug', $topic)->first() : null,
        ]);
    }

    public function show(Post $post)
    {
        // abort_unless($post->published && $post->type === 'news', 404);

        // $post->recordView();

        $relatedNews = Post::published()
            ->ofType('news')
            ->where('language', app()->getLocale())
            ->where('id', '!=', $post->id)
            ->whereHas('tags', fn($q) => $q->whereIn('id', $post->tags->pluck('id')))
            ->inRandomOrder()
            ->take(3)
            ->get();

        if ($relatedNews->count() < 3) {
            $morePosts = Post::published()
                ->ofType('news')
                ->where('language', app()->getLocale())
                ->where('id', '!=', $post->id)
                ->whereNotIn('id', $relatedNews->pluck('id'))
                ->inRandomOrder()
                ->take(3 - $relatedNews->count())
                ->get();

            $relatedNews = $relatedNews->merge($morePosts);
        }

        return view('pages.posts.show', [
            'post' => $post,
            'relatedNews' => $relatedNews,
            // 'hasTranslations' => $post->translations->isNotEmpty(),
            // 'availableTranslations' => $post->translations,
        ]);
    }

    // Other methods for specific news sections
    public function genomeEditing()
    {
        return $this->showNewsByTag('genome-editing', 'Genome Editing');
    }

    public function snpResistance()
    {
        return $this->showNewsByTag('snp-resistance', 'SNP Resistance WSSV');
    }

    public function bambooDisease()
    {
        return $this->showNewsByTag('bamboo-disease', 'Bamboo Disease Analysis');
    }

    public function multilocation()
    {
        return $this->showNewsByTag('multilocation', 'Multilocation Test Results');
    }

    protected function showNewsByTag($tagSlug, $title)
    {
        $tag = Tag::where('slug', $tagSlug)->firstOrFail();

        $posts = Post::with(['tags', 'topics', 'productCategories', 'user'])
            ->published()
            ->ofType('news')
            ->where('language', app()->getLocale())
            ->whereHas('tags', function ($q) use ($tagSlug) {
                $q->where('slug', $tagSlug);
            })
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view('news.tag', [
            'posts' => $posts,
            'tag' => $tag,
            'title' => $title,
            'featuredPosts' => Post::published()->ofType('news')->featured()->take(3)->get(),
            'topTags' => Tag::withCount('posts')->orderBy('posts_count', 'desc')->take(10)->get(),
            'topTopics' => Topic::withCount('posts')->orderBy('posts_count', 'desc')->take(5)->get(),
        ]);
    }
}
