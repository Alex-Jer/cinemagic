<table class="w-full whitespace-no-wrap table-fixed">
    <thead>
        <tr
            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-white border-b dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800">
            <th class="w-1/12 px-4 py-3">ID</th>
            <th class="px-4 py-3">Filme</th>
            <th class="w-2/12 px-4 py-3">Data</th>
            <th class="w-2/12 px-4 py-3">Sala</th>
            <th class="w-2/12 px-4 py-3">Ações</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
        @foreach ($screenings as $screening)
            <tr
                class="text-gray-700 transition duration-75 ease-in-out dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                <td class="px-4 py-3 text-sm font-medium">{{ $screening->id }}</td>
                <td class="px-4 py-3 text-sm font-medium">{{ $screening->film->titulo }}</td>
                <td class="px-4 py-3 text-sm font-medium">
                    {{ $screening->data->format('d/m/Y') . ' ' . $screening->horario_inicio->format('H:i') }}
                </td>
                <td class="px-4 py-3 text-sm font-medium">{{ $screening->screen->nome }}</td>
                <td class="px-4 text-sm font-medium">
                    <div class="flex items-center space-x-2 text-sm">
                        <form method="GET"
                            action="{{ route('admin.screenings.show', ['screening' => $screening]) }}">
                            <button title="Ver detalhes"
                                class="flex items-center justify-between px-1 py-1 text-sm font-medium leading-5 rounded-lg
                                @can('view', $screening) {{ 'text-purple-600 dark:text-gray-400' }}
                                @else
                                    {{ 'text-purple-400 dark:text-gray-600' }} @endcan
                                focus:outline-none focus:shadow-outline-gray"
                                @cannot('view', $screening) {{ 'disabled' }}
                                @endcan>
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
                        @if (Auth::user()->isAdmin())
                            <form method="GET"
                                action="{{ route('admin.screenings.edit', ['screening' => $screening]) }}">
                                <button title="Editar sessão"
                                    class="flex items-center justify-between px-1 py-1 text-sm font-medium leading-5 rounded-lg
                                @can('update', $screening) {{ 'text-purple-600 dark:text-gray-400' }}
                                @else
                                    {{ 'text-purple-400 dark:text-gray-600' }} @endcan
                                focus:outline-none focus:shadow-outline-gray"
                                @cannot('update', $screening)
                                    {{ 'disabled' }}
                                @endcan>
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                        </path>
                                    </svg>
                                </button>
                            </form>
                            <form method="POST"
                                action="{{ route('admin.screenings.destroy', ['screening' => $screening]) }}">
                                @csrf
                                @method('DELETE')
                                <button title="Apagar sessão"
                                    class="flex items-center justify-between px-1 py-1 text-sm font-medium leading-5 rounded-lg
                                @can('delete', $screening) {{ 'text-purple-600 dark:text-gray-400' }}
                                @else
                                    {{ 'text-purple-400 dark:text-gray-600' }} @endcan
                                focus:outline-none focus:shadow-outline-gray"
                                @cannot('delete', $screening)
                                    {{ 'disabled' }}
                                @endcan>
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd">
                                        </path>
                                    </svg>
                                </button>
                            </form>
                        @else
                            <form method="GET"
                                action="{{ route('employee.screenings.validate', ['screening' => $screening]) }}">
                                <button title="Controlo de acesso"
                                    class="flex items-center justify-between px-1 py-1 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                        </path>
                                    </svg>
                                </button>
                            </form> @endif
                                </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
