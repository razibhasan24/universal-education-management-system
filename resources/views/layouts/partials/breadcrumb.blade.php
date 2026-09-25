<nav class="breadcrumb">
    <a href="{{ route('dashboard') }}">
        <i class="fas fa-home"></i>
    </a>

    @if(isset($breadcrumbs) && is_array($breadcrumbs))
        @foreach($breadcrumbs as $label => $url)
            <i class="fas fa-chevron-right text-[10px] sep"></i>
            @if($url && !$loop->last)
                <a href="{{ $url }}">{{ $label }}</a>
            @else
                <span class="text-gray-700 dark:text-gray-300 font-medium">{{ $label }}</span>
            @endif
        @endforeach
    @elseif(View::hasSection('breadcrumbs'))
        @yield('breadcrumbs')
    @else
        <i class="fas fa-chevron-right text-[10px] sep"></i>
        <span class="text-gray-700 dark:text-gray-300 font-medium">{{ $title ?? 'Dashboard' }}</span>
    @endif
</nav>
