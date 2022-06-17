<table class="w-full whitespace-no-wrap">
    <thead>
        <tr
            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-white border-b dark:border-gray-700 dark:text-gray-300 dark:bg-gray-800">
            <th class="px-4 py-3">Filme</th>
            <th class="px-4 py-3">Sala</th>
            <th class="px-4 py-3">Lugar</th>
            <th class="px-4 py-3">Data</th>
            <th class="px-4 py-3">Início</th>
            <th class="px-4 py-3">Preço</th>
            <th class="px-4 py-3">Ações</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
        @foreach ($cart as $key => $ticket)
            <tr class="text-gray-700 dark:text-gray-300">
                <td class="px-4 py-3">
                    <div class="flex items-center text-sm">
                        <a href="{{ route('films.show', $ticket['screening']->film->id) }}">
                            <p class="font-semibold">{{ $ticket['screening']->film->titulo }}</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                Género:
                                <span class="font-semibold">
                                    {{ $ticket['screening']->film->genre->nome }}
                                </span>
                            </p>
                        </a>
                    </div>
                </td>
                <td class="px-4 py-3 text-sm font-medium">{{ $ticket['seat']->screen->nome }}</td>
                <td class="px-4 py-3 text-sm font-medium">{{ $ticket['seat']->fila . $ticket['seat']->posicao }}</td>
                <td class="px-4 py-3 text-sm font-medium">{{ $ticket['screening']->data->format('d/m/Y') }}</td>
                <td class="px-4 py-3 text-sm font-medium">{{ $ticket['screening']->horario_inicio->format('H:i') }}</td>
                <td class="px-4 py-3 text-sm font-medium">
                    {{ ticket_price('€') }}
                </td>

                <td class="px-4 py-3">
                    <div class="flex items-center space-x-4 text-sm">
                        <form method="POST" action="{{ route('cart.destroy', ['key' => $key]) }}">
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
