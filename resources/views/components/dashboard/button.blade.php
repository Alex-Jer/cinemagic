<button type="submit" {{ $attributes->merge(['class' => 'button-primary ' . $class]) }}>
    {{ $slot }}
    <span>{{ $label }}</span>
</button>
