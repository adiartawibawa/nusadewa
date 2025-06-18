<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $featuredProducts = Post::with(['productCategories'])
            ->where('type', 'product')
            ->where('language', app()->getLocale())
            ->where('is_featured', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $products = Post::with(['productCategories'])
            ->where('type', 'product')
            ->where('language', app()->getLocale())
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->whereNotIn('id', $featuredProducts->pluck('id'))
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        $categories = ProductCategory::withCount(['posts' => function ($query) {
            $query->where('type', 'product')
                ->where('language', app()->getLocale())
                ->whereNotNull('published_at')
                ->where('published_at', '<=', now());
        }])
            ->orderBy('posts_count', 'desc')
            ->get();

        return view('products.index', [
            'featuredProducts' => $featuredProducts,
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function show(Post $product)
    {
        if ($product->type !== 'product' || !$product->published_at || $product->published_at > now()) {
            abort(404);
        }

        $relatedProducts = Post::where('type', 'product')
            ->where('language', app()->getLocale())
            ->where('id', '!=', $product->id)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->whereHas('productCategories', function ($q) use ($product) {
                $q->whereIn('id', $product->productCategories->pluck('id'));
            })
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('products.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    public function category(ProductCategory $category)
    {
        $products = Post::with(['productCategories'])
            ->where('type', 'product')
            ->where('language', app()->getLocale())
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->whereHas('productCategories', function ($q) use ($category) {
                $q->where('id', $category->id);
            })
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        return view('products.category', [
            'category' => $category,
            'products' => $products,
        ]);
    }
}
