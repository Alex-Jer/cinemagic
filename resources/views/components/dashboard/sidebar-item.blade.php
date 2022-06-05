<li class="relative px-6 py-3">
    <span class="absolute {{ request()->is($route) ? 'inset-y-0' : '' }} left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
        aria-hidden="true"></span>
    <a class="{{ request()->is($route) ? 'text-gray-800' : '' }} inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
        href="@if ($route) {{ route($route) }} @endif">
        {{ $slot }}
        <span class="ml-4">{{ $label }}</span>
    </a>
</li>
