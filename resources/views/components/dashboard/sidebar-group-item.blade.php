<li class="relative pl-2 mt-2">
    <a class="inline-flex w-full text-sm font-semibold transition-colors duration-150 utems-center hover:text-gray-800 dark:hover:text-gray-200"
        href="@if ($route) {{ route($route . '.index') }} @endif">
        {{ $slot }}
        <span class="pl-1.5">{{ $label }}</span>
    </a>
</li>
