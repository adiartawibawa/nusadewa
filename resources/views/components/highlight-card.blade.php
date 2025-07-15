@props([
    'title' => 'Card Title',
    'description' => 'Card description goes here.',
    'link' => null,
    'linkText' => 'Read more →',
    'icon' => 'info-circle',
    'color' => 'sky', // only allow values in defined list below
])

@php
    // Pemetaan class Tailwind berdasarkan warna
    $colors = [
        'sky' => [
            'bg' => 'bg-sky-500',
            'hover' => 'group-hover:bg-sky-400',
            'text' => 'text-sky-500',
        ],
        'blue' => [
            'bg' => 'bg-blue-500',
            'hover' => 'group-hover:bg-blue-400',
            'text' => 'text-blue-500',
        ],
        'indigo' => [
            'bg' => 'bg-indigo-500',
            'hover' => 'group-hover:bg-indigo-400',
            'text' => 'text-indigo-500',
        ],
        'teal' => [
            'bg' => 'bg-teal-500',
            'hover' => 'group-hover:bg-teal-400',
            'text' => 'text-teal-500',
        ],
        'amber' => [
            'bg' => 'bg-amber-500',
            'hover' => 'group-hover:bg-amber-400',
            'text' => 'text-amber-500',
        ],
        'green' => [
            'bg' => 'bg-green-500',
            'hover' => 'group-hover:bg-green-400',
            'text' => 'text-green-500',
        ],
        'rose' => [
            'bg' => 'bg-rose-500',
            'hover' => 'group-hover:bg-rose-400',
            'text' => 'text-rose-500',
        ],
    ];

    $theme = $colors[$color] ?? $colors['sky']; // fallback ke sky jika tidak ditemukan
@endphp

<div
    class="relative px-6 pt-10 pb-8 overflow-hidden transition-all duration-300 bg-white shadow-xl cursor-pointer group ring-1 ring-gray-900/5 hover:-translate-y-1 hover:shadow-2xl sm:mx-auto sm:max-w-sm sm:rounded-lg sm:px-10">
    <!-- Background Bubble -->
    <span
        class="absolute top-10 z-0 h-20 w-20 rounded-full {{ $theme['bg'] }} transition-all duration-300 group-hover:scale-[10]"></span>

    <div class="relative z-10 max-w-md mx-auto">
        <!-- Icon Bubble -->
        <span
            class="grid h-20 w-20 place-items-center rounded-full {{ $theme['bg'] }} transition-all duration-300 {{ $theme['hover'] }}">
            <i class="text-white text-3xl fas fa-{{ $icon }}"></i>
        </span>

        <!-- Title & Description -->
        <div
            class="pt-5 space-y-6 text-base leading-7 text-gray-600 transition-all duration-300 group-hover:text-white/90">
            <h3 class="text-xl font-bold text-gray-900 group-hover:text-white">{{ $title }}</h3>
            <p>{{ $description }}</p>
        </div>

        <!-- Link Section -->
        @if ($link)
            <div class="pt-5 text-base font-semibold leading-7">
                <p>
                    <a href="{{ $link }}"
                        class="{{ $theme['text'] }} transition-all duration-300 group-hover:text-white">
                        {{ $linkText }}
                    </a>
                </p>
            </div>
        @endif
    </div>
</div>
