@props(['messages'])

@if ($messages)
<<<<<<< HEAD
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
=======
    <div {{ $attributes->merge(['class' => 'invalid-feedback']) }}>
        @foreach ((array) $messages as $message)
            <div>{{ $message }}</div>
        @endforeach
    </div>
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
@endif
