@props(['value'])

<<<<<<< HEAD
<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 dark:text-gray-300']) }}>
=======
<label {{ $attributes->merge(['class' => 'form-label fw-medium']) }}>
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
    {{ $value ?? $slot }}
</label>
