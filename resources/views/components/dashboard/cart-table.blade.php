<table class="w-full whitespace-no-wrap">
    <thead>
        <tr
            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-white border-b dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">Filme</th>
            <th class="px-4 py-3">Sala</th>
            <th class="px-4 py-3">Data</th>
            <th class="px-4 py-3">Início</th>
            <th class="px-4 py-3">Preço</th>
            <th class="px-4 py-3">Ações</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
        @foreach ($cart as $key => $ticket)
            {{-- The first value in the array is the configuration --}}
            @if ($key === 'config')
                @continue
            @endif
            <tr class="text-gray-700 dark:text-gray-400">
                <td class="px-4 py-3">
                    <div class="flex items-center text-sm">
                        <div>
                            {{-- @dd($key) --}}
                            <p class="font-semibold">{{ $ticket['screening']->film->titulo }}</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                Género:
                                <span class="font-semibold">
                                    {{ $ticket['screening']->film->genre->nome }}
                                </span>
                            </p>
                        </div>
                    </div>
                </td>
                <td class="px-4 py-3 text-sm">{{ $ticket['seat']->screen->nome }}</td>
                <td class="px-4 py-3 text-sm">{{ $ticket['screening']->data }}</td>
                <td class="px-4 py-3 text-sm">{{ $ticket['screening']->horario_inicio }}</td>
                <td class="px-4 py-3 text-sm">
                    {{ round($cart['config']->preco_bilhete_sem_iva + ($cart['config']->preco_bilhete_sem_iva * $cart['config']->percentagem_iva) / 100, 2) }}
                    €
                </td>

                <td class="px-4 py-3">
                    <div class="flex items-center space-x-4 text-sm">
                        <form method="POST" action="{{ route('cart.destroy', ['key' => $key]) }}">
                            {{-- cart/screenings/{{ $ticket['screening']->id }} --}}
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                aria-label="Delete">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>