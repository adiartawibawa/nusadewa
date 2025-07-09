<?php

namespace App\View\Components;

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

    protected function prepareMenuItems()
    {
        $products = Post::where('type', 'product')
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->get(['id', 'slug', 'title', 'type'])
            ->map(function ($item) {
                return [
                    'label' => $item->title,
                    'url' => route('news.show', $item->slug)
                ];
            });

        $technologies = Post::where('type', 'technology')
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->get(['id', 'slug', 'title', 'type'])
            ->map(function ($item) {
                return [
                    'label' => $item->title,
                    'url' => route('news.show', $item->slug)
                ];
            });

        $this->menuItems = [
            'home' => [
                'route' => route('home'),
                'children' => false,
            ],
            'about' => [
                'route' => '#',
                'children' => [
                    [
                        'label' => __('Innovation'),
                        'url' => '#innovation'
                    ],
                    [
                        'label' => __('Our Expertise'),
                        'url' => '#technology'
                    ],
                    [
                        'label' => __('Our Team'),
                        'url' => '#team'
                    ],
                ],
            ],
            'products' => [
                'route' => '#',
                'children' => $products,
            ],
            'technology' => [
                'route' => '#',
                'children' => $technologies,
            ],
            'news' => [
                'route' => '#news',
                'children' => false,
            ],
            'contact' => [
                'route' => '#contact',
                'children' => false,
            ],
        ];
    }

    public function render()
    {
        return view('components.layouts.navigation');
    }
}
