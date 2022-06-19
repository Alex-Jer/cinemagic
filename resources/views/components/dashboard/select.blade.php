<label class="block mb-4 text-sm">
    <span class="dark:text-gray-400">{{ $label }}</span>
    <select class="text-gray-700 dark:text-gray-400 input-primary" name="{{ $name }}" {{ $attributes }}>
        {{ $slot }}
    </select>
</label>
