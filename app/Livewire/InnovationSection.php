<?php

namespace App\Livewire;

use App\Enums\PostType;
use App\Models\Post;
use Livewire\Component;

class InnovationSection extends Component
{
    public $currentIndex = 1;
    public $innovations;

    public function mount()
    {
        $this->innovations = Post::with(['user', 'tags'])
            ->where('type', PostType::INNOVATION->value)
            ->published()
            ->orderByDesc('published_at')
            ->take(7)
            ->get()
            ->toArray();
    }

    public function next()
    {
        $this->currentIndex = ($this->currentIndex + 1) % count($this->innovations);
    }

    public function previous()
    {
        $this->currentIndex = ($this->currentIndex - 1 + count($this->innovations)) % count($this->innovations);
    }

    public function selectCard($index)
    {
        $this->currentIndex = $index;
    }

    public function render()
    {
        $cards = [];
        $count = count($this->innovations);

        if ($count > 0) {
            for ($i = -2; $i <= 2; $i++) {
                $index = ($this->currentIndex + $i + $count) % $count;
                $cards[] = [
                    'data' => $this->innovations[$index],
                    'position' => $i,
                    'zIndex' => 30 - abs($i) * 5,
                    'opacity' => 1 - abs($i) * 0.2,
                    'scale' => 1 - abs($i) * 0.1
                ];
            }
        }

        return view('livewire.innovation-section', [
            'cards' => $cards,
            'totalInnovations' => $count
        ]);
    }
}
