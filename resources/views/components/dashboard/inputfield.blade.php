@props(['type' => 'text'])
<label class="block text-sm ">
    <span class="dark:text-gray-400">{{ $label }}</span>
    <input class="mb-4 input-primary" name="{{ $name }}" type="{{ $type }}" placeholder="{{ $placeholder }}"
        {{ $attr }} value="{{ $value }}">
</label>
