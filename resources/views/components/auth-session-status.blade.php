@props(['status'])

@if ($status)
<<<<<<< HEAD
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600 dark:text-green-400']) }}>
        {{ $status }}
=======
    <div {{ $attributes->merge(['class' => 'alert alert-success alert-dismissible fade show']) }} role="alert">
        {{ $status }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
    </div>
@endif
