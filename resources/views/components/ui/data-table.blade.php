@props([
    'headers' => [],
    'empty' => 'No data found',
    'paginator' => null,
])

<div class="card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    @foreach($headers as $header)
                        <th class="{{ $header['class'] ?? '' }}">{{ $header['label'] ?? $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                {{ $slot }}
            </tbody>
        </table>
    </div>

    @if($paginator && $paginator->hasPages())
        <div class="card-footer">
            {{ $paginator->links() }}
        </div>
    @endif
</div>
