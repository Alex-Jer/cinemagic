<x-guest-layout>
    <div class="flex flex-col items-center min-h-screen pt-6 sm:justify-center sm:pt-0">
        <a class="mt-6 ml-6 text-3xl font-bold text-gray-800 dark:text-gray-200" href="#">
            CineMagic
        </a>

        <div class="w-full px-6 py-4 mt-6 overflow-hidden max-w-screen-2xl sm:rounded-lg">

            <div class="grid gap-6 mb-8">
                <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                    <p class="mb-0">Olá, {{ auth()->user()->name }},</p>
                    <p class="mb-0">obrigado pela compra</p>
                    <p class="mt-1 text-sm text-gray-500">
                        {{ $receipt->created_at->translatedFormat('l\, j \d\e F \d\e Y \à\s H:i:s') }}
                    </p>
                </h4>

                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-white border-b dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Filme</th>
                            <th class="px-4 py-3">Sala</th>
                            <th class="px-4 py-3">Data</th>
                            <th class="px-4 py-3">Início</th>
                            <th class="px-4 py-3">Lugar</th>
                            <th class="px-4 py-3">Preço</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($receipt->tickets as $ticket)
                            <tr class="text-gray-700 transition duration-100 ease-in-out dark:text-gray-400">
                                <td class="px-4 py-3 text-sm font-medium">{{ $ticket->id }}</td>
                                <td class="px-4 py-3 text-sm font-medium">{{ $ticket->screening->film->titulo }}</td>
                                <td class="px-4 py-3 text-sm font-medium">{{ $ticket->screening->screen->nome }}</td>
                                <td class="px-4 py-3 text-sm font-medium">
                                    {{ $ticket->screening->data->translatedFormat('d/m/Y \(l\)') }}</td>
                                <td class="px-4 py-3 text-sm font-medium">
                                    {{ $ticket->screening->horario_inicio->translatedFormat('H:i') }}
                                </td>
                                <td class="px-4 py-3 text-sm font-medium">
                                    {{ $ticket->seat->fila . $ticket->seat->posicao }}
                                </td>
                                <td class="px-4 py-3 text-sm font-medium">
                                    {{ round($ticket->preco_sem_iva + ($ticket->preco_sem_iva * $receipt->iva) / 100, 2) . '€' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <table class="w-full whitespace-no-wrap table-fixed">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-white border-b dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800">
                            <th class="invisible w-11/12 px-4 py-3"></th>
                            <th class="invisible px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <tr class="text-gray-700 transition duration-100 ease-in-out dark:text-gray-400">
                            <td class="px-4 py-3 text-sm font-medium">Total sem IVA</td>
                            <td class="px-4 py-3 text-sm font-medium">{{ $receipt->preco_total_sem_iva }}€</td>
                        </tr>
                        <tr class="text-gray-700 transition duration-100 ease-in-out dark:text-gray-400">
                            <td class="px-4 py-3 text-sm font-medium">IVA</td>
                            <td class="px-4 py-3 text-sm font-medium">{{ $receipt->iva }}%</td>
                        </tr>
                        <tr
                            class="text-lg font-bold text-gray-700 transition duration-100 ease-in-out dark:text-gray-400">
                            <td class="px-4 py-3">Total com IVA</td>
                            <td class="px-4 py-3">{{ $receipt->preco_total_com_iva }}€</td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-5 -mb-8 text-xl font-semibold dark:text-gray-200">Os seus detalhes</div>

                <table class="w-1/2 whitespace-no-wrap table-fixed">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-white border-b dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800">
                            <th class="invisible w-1/3 px-4 py-3"></th>
                            <th class="invisible w-2/3 px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <tr class="text-gray-700 transition duration-100 ease-in-out dark:text-gray-400">
                            <td class="px-4 py-3 text-sm font-medium">Nome do cliente</td>
                            <td class="px-4 py-3 text-sm font-medium">{{ $receipt->nome_cliente }}</td>
                        </tr>
                        <tr class="text-gray-700 transition duration-100 ease-in-out dark:text-gray-400">
                            <td class="px-4 py-3 text-sm font-medium">Tipo de pagamento</td>
                            <td class="px-4 py-3 text-sm font-medium">{{ $receipt->tipo_pagamento }}</td>
                        </tr>
                        <tr class="text-gray-700 transition duration-100 ease-in-out dark:text-gray-400">
                            <td class="px-4 py-3 text-sm font-medium">Referência</td>
                            <td class="px-4 py-3 text-sm font-medium">{{ $receipt->ref_pagamento }}</td>
                        </tr>
                        <tr class="text-gray-700 transition duration-100 ease-in-out dark:text-gray-400">
                            <td class="px-4 py-3 text-sm font-medium">NIF</td>
                            @if ($receipt->nif_pagamento)
                                <td class="px-4 py-3 text-sm font-medium">{{ $receipt->ref_pagamento }}</td>
                            @else
                                <td class="px-4 py-3 text-sm font-medium">N/A</td>
                            @endif
                        </tr>
                    </tbody>
                </table>

                <div class="text-sm dark:text-gray-400">
                    Se desejar consultar o recibo no site,
                    <a href="{{ route('receipts.show', ['receipt' => $receipt]) }}" target="_blank"
                        class="font-semibold text-purple-600">
                        clique aqui.
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>
