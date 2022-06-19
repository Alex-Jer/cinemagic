<table class="w-full whitespace-no-wrap table-fixed">
    <thead>
        <tr
            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-white border-b dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800">
            <th class="w-1/12 px-4 py-3">ID</th>
            <th class="w-8/12 px-4 py-3">Título</th>
            <th class="w-2/12 px-4 py-3">Género</th>
            <th class="w-1/12 px-4 py-3">Ano</th>
            <th class="w-2/12 px-4 py-3">Ações</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
        @foreach ($films as $film)
            <tr
                class="text-gray-700 transition duration-75 ease-in-out dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                <td class="px-4 py-3 text-sm font-medium">{{ $film->id }}</td>
                <td class="px-4 py-3 text-sm font-medium">{{ $film->titulo }}</td>
                <td class="px-4 py-3 text-sm font-medium">{{ $film->genre->nome }}</td>
                <td class="px-4 py-3 text-sm font-medium">{{ $film->ano }}</td>
                <td class="px-4 text-sm font-medium">
                    <div class="flex items-center space-x-2 text-sm">
                        <form method="GET" action="{{ route('admin.screenings.create', ['film' => $film]) }}">
                            <button title="Agendar sessão"
                                class="flex items-center justify-between px-1 py-1 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </form>
                        <form method="GET" action="{{ route('films.show', ['film' => $film]) }}">
                            <button title="Ver detalhes"
                                class="flex items-center justify-between px-1 py-1 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                </svg>
                            </button>
                        </form>
                        <form method="GET" action="{{ route('admin.films.edit', ['film' => $film]) }}">
                            <button title="Editar filme"
                                class="flex items-center justify-between px-1 py-1 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                    </path>
                                </svg>
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.films.destroy', ['film' => $film]) }}">
                            @csrf
                            @method('DELETE')
                            <button title="Apagar filme"
                                class="flex items-center justify-between px-1 py-1 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd">
                                    </path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
