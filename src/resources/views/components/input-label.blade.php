@props(['value', 'is_required' => false])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 dark:text-gray-300']) }}>
    {{-- if required shows * red --}}
    @if ($is_required)
        <span class="text-red-500">*</span>
    @endif
    {{ $value ?? $slot }}
</label>
