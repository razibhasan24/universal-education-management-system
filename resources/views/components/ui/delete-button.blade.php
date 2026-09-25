@props(['action', 'title' => 'Are you sure?', 'message' => 'You won\'t be able to revert this!'])

@php
$formId = 'delete-form-' . uniqid();
@endphp

<form id="{{ $formId }}" action="{{ $action }}" method="POST" class="inline">
    @csrf
    @method('DELETE')
    <button type="button"
            onclick="window.dispatchEvent(new CustomEvent('open-delete-modal', {
                detail: {
                    formId: '{{ $formId }}',
                    title: '{{ $title }}',
                    message: '{{ $message }}'
                }
            }))"
            {{ $attributes->merge(['class' => 'btn-danger btn-sm']) }}>
        <i class="fas fa-trash"></i>
        {{ $slot->isEmpty() ? '' : $slot }}
    </button>
</form>
