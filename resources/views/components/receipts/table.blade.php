<div class="min-w-0 col-span-1 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
    <div class="mb-4 ml-3 text-2xl font-semibold dark:text-gray-200">Recibo #{{ $receipt->id }}</div>
    <h4 class="mb-4 ml-3 font-semibold text-gray-600 dark:text-gray-300">Bilhetes</h4>
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
</div>

<div class="grid gap-6 mb-8 md:grid-cols-3">
    <div class="min-w-0 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <table class="whitespace-no-wrap table-fixed">
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
                <tr class="text-lg font-bold text-gray-700 transition duration-100 ease-in-out dark:text-gray-400">
                    <td class="px-4 py-3">Total (com IVA)</td>
                    <td class="px-4 py-3">{{ $receipt->preco_total_com_iva }}€</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
