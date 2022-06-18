@if ($mode == 'edit')
    <label class="block text-sm ">
        <span class="dark:text-gray-400">{{ $label }}</span>
        <input class="mb-4 input-primary" name="{{ $name }}" type="text" placeholder="{{ $content }}"
            {{ $attr }} value="{{ $value }}">
    </label>
@else
    <label class="block text-sm ">
        <span class="dark:text-gray-400">{{ $label }}</span>
        <input class="mb-4 input-primary" name="{{ $name }}" type="text" value="{{ $content }}" readonly
            {{ $attr }} />
    </label>
@endif
