<button type="submit" data-tooltip-target="tooltip-bottom" data-tooltip-placement="bottom" {{ $attributes }}>
    {{ $slot }}
    @if ($tooltip ?? null)
        <div id="tooltip-bottom" role="tooltip"
            class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            {{ $tooltip }}
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    @endif
    <span>{{ $label }}</span>
</button>
