<li class="relative pl-2 mt-2">
    <a class="inline-flex utems-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
        href="@if ($route) {{ route($route) }} @endif">
        {{ $slot }}
        <span class="pl-1.5">{{ $label }}</span>
    </a>
</li>
