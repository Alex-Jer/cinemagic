<table class="w-full whitespace-no-wrap">
    <thead>
        <tr
            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-white border-b dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">Hora</th>
            <th class="px-4 py-3">Dia</th>
            <th class="px-4 py-3">Sala</th>
            <th class="px-4 py-3">Estado</th>
            @if (!Auth::user())
                <th class="xl:w-3/12 px-4 py-3">Comprar bilhete</th>
            @elseif (Auth::user()->isCustomer())
                <th class="xl:w-3/12 px-4 py-3">Comprar bilhete</th>
            @endif
        </tr>
    </thead>
    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
        @foreach ($film->screenings as $screening)
            <tr class="text-gray-700 dark:text-gray-400">
                <td class="px-4 py-3 text-sm font-medium">{{ $screening->horario_inicio->format('H:i') }}</td>
                <td class="px-4 py-3 text-sm font-medium">{{ $screening->data->format('d/m/Y') }}</td>
                <td class="px-4 py-3 text-sm font-medium">{{ $screening->screen->nome }}</td>
                <td class="px-4 py-3 text-sm font-medium">
                    {{ $screening->tickets->count() === $screening->screen->seats->count()
                        ? 'Esgotada'
                        : $screening->screen->seats->count() - $screening->tickets->count() . ' lugares livres' }}
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center space-x-4 text-sm">
                        <a href="{{ route('screenings.show', $screening) }}">
                            <x-dashboard.button label="Comprar bilhete">
                                <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                                    </path>
                                </svg>
                            </x-dashboard.button>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
