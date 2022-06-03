<label class="block text-sm ">
    <span {{ $attributes->merge(['class' => 'dark:text-gray-400 ' . $color]) }}>{{ $label }}</span>
    <input class="mb-4 input-primary" name="{{ $name }}" type="text" placeholder="{{ $placeholder }}"
        {{ $attr }} />
</label>
