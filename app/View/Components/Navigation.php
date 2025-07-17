<?php

namespace App\View\Components;

use App\Enums\PostType;
use Illuminate\View\Component;
use App\Models\Post;

class Navigation extends Component
{
    public $type;
    public $menuItems;

    public function __construct($type = 'desktop')
    {
        $this->type = $type;

        $this->prepareMenuItems();
    }

    protected function rootUrlWithLocale(): string
    {
        return url(app()->getLocale());
    }

    protected function prepareMenuItems()
    {
        $products = Post::where('type', PostType::PRODUCT->value)
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->get(['id', 'slug', 'title', 'type'])
            ->map(function ($item) {
                return [
                    'label' => $item->title,
                    'url' => route('products.show', $item->slug)
                ];
            });

        $technologies = Post::where('type', PostType::INNOVATION->value)
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->get(['id', 'slug', 'title', 'type'])
            ->map(function ($item) {
                return [
                    'label' => $item->title,
                    'url' => route('innovations.show', $item->slug)
                ];
            });

        $this->menuItems = [
            'home' => [
                'route' => route('home'),
                'children' => false,
                'label' => __('app.menu.home.label')
            ],
            'about' => [
                'route' => $this->rootUrlWithLocale() . '#about',
                'label' => __('app.menu.about.label'),
                'children' => [
                    [
                        'label' => __('app.menu.about.children.innovation'),
                        'url' => $this->rootUrlWithLocale() . '#innovation'
                    ],
                    [
                        'label' => __('app.menu.about.children.expertise'),
                        'url' => $this->rootUrlWithLocale() . '#technology'
                    ],
                    [
                        'label' => __('app.menu.about.children.team'),
                        'url' => $this->rootUrlWithLocale() . '#team'
                    ],
                ],
            ],
            'products' => [
                'route' => $this->rootUrlWithLocale() . '#products',
                'label' => __('app.menu.products.label'),
                'children' => $products,
            ],
            'technology' => [
                'route' => $this->rootUrlWithLocale() . '#technology',
                'label' => __('app.menu.technology.label'),
                'children' => $technologies,
            ],
            'news' => [
                'route' => $this->rootUrlWithLocale() . '#news',
                'label' => __('app.menu.news.label'),
                'children' => false,
            ],
            'contact' => [
                'route' => $this->rootUrlWithLocale() . '#contact',
                'label' => __('app.menu.contact.label'),
                'children' => false,
            ],
        ];
    }

    public function render()
    {
        return view('components.layouts.navigation');
    }
}
