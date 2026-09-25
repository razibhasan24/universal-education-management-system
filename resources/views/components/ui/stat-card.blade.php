@props([
    'title' => '',
    'value' => '0',
    'icon' => 'chart-line',
    'color' => 'indigo',
    'link' => null,
    'trend' => null,
    'trendValue' => null,
])

@php
$colors = [
    'indigo' => ['bg' => 'bg-indigo-100 dark:bg-indigo-900/30', 'text' => 'text-indigo-600 dark:text-indigo-400', 'border' => 'border-indigo-500'],
    'green'  => ['bg' => 'bg-green-100 dark:bg-green-900/30',   'text' => 'text-green-600 dark:text-green-400',   'border' => 'border-green-500'],
    'red'    => ['bg' => 'bg-red-100 dark:bg-red-900/30',       'text' => 'text-red-600 dark:text-red-400',       'border' => 'border-red-500'],
    'yellow' => ['bg' => 'bg-yellow-100 dark:bg-yellow-900/30', 'text' => 'text-yellow-600 dark:text-yellow-400', 'border' => 'border-yellow-500'],
    'blue'   => ['bg' => 'bg-blue-100 dark:bg-blue-900/30',     'text' => 'text-blue-600 dark:text-blue-400',     'border' => 'border-blue-500'],
    'purple' => ['bg' => 'bg-purple-100 dark:bg-purple-900/30', 'text' => 'text-purple-600 dark:text-purple-400', 'border' => 'border-purple-500'],
    'pink'   => ['bg' => 'bg-pink-100 dark:bg-pink-900/30',     'text' => 'text-pink-600 dark:text-pink-400',     'border' => 'border-pink-500'],
];

$c = $colors[$color] ?? $colors['indigo'];
$tag = $link ? 'a' : 'div';
@endphp

<{{ $tag }} @if($link) href="{{ $link }}" @endif
    class="card p-5 border-l-4 {{ $c['border'] }} hover:shadow-md transition-all duration-200 block group">

    <div class="flex items-center justify-between">
        <div class="min-w-0">
            <p class="text-xs md:text-sm font-medium text-gray-500 dark:text-gray-400 truncate uppercase tracking-wide">
                {{ $title }}
            </p>
            <p class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-gray-100 mt-1.5">
                {{ $value }}
            </p>
            @if($trend && $trendValue)
                <p class="text-xs mt-1.5 flex items-center gap-1 {{ $trend === 'up' ? 'text-green-500' : 'text-red-500' }}">
                    <i class="fas fa-arrow-{{ $trend }}"></i>
                    {{ $trendValue }}
                </p>
            @endif
        </div>
        <div class="{{ $c['bg'] }} rounded-xl p-3 md:p-4 transition-transform group-hover:scale-110">
            <i class="fas fa-{{ $icon }} {{ $c['text'] }} text-xl md:text-2xl"></i>
        </div>
    </div>
</{{ $tag }}>
