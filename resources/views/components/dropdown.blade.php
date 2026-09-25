<<<<<<< HEAD
@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white dark:bg-gray-700'])

@php
$alignmentClasses = match ($align) {
    'left' => 'ltr:origin-top-left rtl:origin-top-right start-0',
    'top' => 'origin-top',
    default => 'ltr:origin-top-right rtl:origin-top-left end-0',
};

$width = match ($width) {
=======
@props(['align' => 'end', 'width' => '48'])

@php
$alignmentClasses = match ($align) {
    'left' => 'start-0',
    'top' => 'top-0',
    default => 'end-0',
};
$widthClass = match ($width) {
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
    '48' => 'w-48',
    default => $width,
};
@endphp

<<<<<<< HEAD
<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
=======
<div class="position-relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
<<<<<<< HEAD
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute z-50 mt-2 {{ $width }} rounded-md shadow-lg {{ $alignmentClasses }}"
            style="display: none;"
            @click="open = false">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
=======
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="position-absolute z-50 mt-2 {{ $widthClass }} rounded-3 shadow {{ $alignmentClasses }}"
         style="display: none;"
         @click="open = false">
        <div class="rounded-3 {{ $contentClasses ?? 'py-1 bg-white' }}">
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
            {{ $content }}
        </div>
    </div>
</div>
