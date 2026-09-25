@props(['icon' => 'inbox', 'title' => 'No data found', 'message' => null])

<div class="text-center py-12">
    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-100 dark:bg-gray-700 mb-4">
        <i class="fas fa-{{ $icon }} text-gray-400 text-3xl"></i>
    </div>
    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ $title }}</h3>
    @if($message)
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $message }}</p>
    @endif
    @if($slot->isNotEmpty())
        <div class="mt-4">{{ $slot }}</div>
    @endif
</div>
