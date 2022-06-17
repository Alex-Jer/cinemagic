<table class="w-full whitespace-no-wrap table-fixed">
    <thead>
        <tr
            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-white border-b dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">ID do recibo</th>
            <th class="px-4 py-3">Data de compra</th>
            <th class="px-4 py-3">Data da sessão</th>
            <th class="px-4 py-3 w-3/12">Filme</th>
            <th class="px-4 py-3">Sala</th>
            <th class="px-4 py-3 w-1/12">Lugar</th>
            <th class="px-4 py-3 w-1/12">Preço</th>
            <th class="px-4 py-3 w-1/12">Estado</th>
            <th class="px-4 py-3 w-1/12">Ações</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
        @foreach ($tickets as $ticket)
            <tr
                class="text-gray-700 transition duration-100 ease-in-out dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900">
                <td class="px-4 py-3 text-sm font-medium">{{ $ticket->id }}</td>
                <td class="px-4 py-3 text-sm font-medium">{{ $ticket->receipt->data->format('d/m/Y') }}</td>
                <td class="px-4 py-3 text-sm font-medium">{{ $ticket->screening->data->format('d/m/Y') }}</td>
                <td class="px-4 py-3 text-sm font-medium">{{ $ticket->screening->film->titulo }}</td>
                <td class="px-4 py-3 text-sm font-medium">{{ $ticket->screening->screen->nome }}</td>
                <td class="px-4 py-3 text-sm font-medium">{{ $ticket->seat->fila . $ticket->seat->posicao }}</td>
                <td class="px-4 py-3 text-sm font-medium">{{ ticket_price('€') }}</td>
                <td class="px-4 py-3 text-sm font-medium">{{ $ticket->estado === 'usado' ? 'Usado' : 'Não usado' }}</td>
                <td class="px-4 py-3">
                    <div class="flex items-center space-x-3 text-sm">
                        <a title="Ver detalhes" href="{{ route('tickets.show', $ticket) }}"
                            class="flex items-center justify-between px-1 py-1 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-purple-500 focus:outline-none focus:shadow-outline-gray"
                            aria-label="PDF">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </a>
                        <a title="Download PDF" href="{{ route('tickets.get_pdf', $ticket) }}"
                            class="flex items-center justify-between px-1 py-1 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-purple-500 focus:outline-none focus:shadow-outline-gray"
                            aria-label="PDF">
                            <svg class="w-5 h-5" data-darkreader-inline-stroke="" fill="none" stroke="currentColor"
                                style="--darkreader-inline-stroke: currentColor;" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
