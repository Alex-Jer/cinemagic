<table class="w-full whitespace-no-wrap table-fixed">
    <thead>
        <tr
            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-white dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">Sala</th>
            <th class="px-4 py-3">Dia</th>
            <th class="px-4 py-3">Hora</th>
            <th class="px-4 py-3 w-2/12">Comprar bilhete</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
        @foreach ($film->screenings as $screening)
            @if ($screening->data . $screening->horario_inicio >= now())
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <p class="font-semibold">{{ $screening->screen->nome }}</p>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <p class="font-semibold">{{ $screening->data }}</p>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <p class="font-semibold">{{ $screening->horario_inicio }}</p>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                            <form method="POST" action="{{ route('cart.store', $screening) }}"
                                class="mt-3">
                                @csrf
                                <x-dashboard.button label="Comprar bilhete">
                                    <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                                        </path>
                                    </svg>
                                </x-dashboard.button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>