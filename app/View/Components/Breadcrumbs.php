<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumbs extends Component
{
    public $items;
    public $currentItem;

    /**
     * Create a new component instance.
     *
     * @param array $items Array of breadcrumb items
     * @param string|null $currentItem Current page title (optional)
     */
    public function __construct($items = [], $currentItem = null)
    {
        $this->items = $items;
        $this->currentItem = $currentItem;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.breadcrumbs');
    }
}
