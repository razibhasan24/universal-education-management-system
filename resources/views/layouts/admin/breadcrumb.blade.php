<div class="admin-breadcrumb bg-light border-bottom px-3 px-lg-4" x-data="{ breadcrumbs: @json($breadcrumbs ?? []) }">
    <nav aria-label="breadcrumb" class="mb-0">
        <ol class="breadcrumb mb-0 py-2">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">
                    <i class="bi bi-house-door-fill me-1"></i>Home
                </a>
            </li>
            
            @foreach($breadcrumbs as $index => $breadcrumb)
                @if($index === array_key_last($breadcrumbs))
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $breadcrumb['label'] }}
                    </li>
                @else
                    <li class="breadcrumb-item">
                        @if(isset($breadcrumb['url']))
                            <a href="{{ $breadcrumb['url'] }}" class="text-decoration-none">{{ $breadcrumb['label'] }}</a>
                        @else
                            {{ $breadcrumb['label'] }}
                        @endif
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
</div>