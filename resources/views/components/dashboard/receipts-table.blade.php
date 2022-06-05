<table class="w-full whitespace-no-wrap">
    <thead>
        <tr
            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">ID do recibo</th>
            <th class="px-4 py-3">Data</th>
            <th class="px-4 py-3">Modo de pagamento</th>
            <th class="px-4 py-3">Referência de pagamento</th>
            <th class="px-4 py-3">NIF</th>
            <th class="px-4 py-3">Preço sem IVA</th>
            <th class="px-4 py-3">IVA</th>
            <th class="px-4 py-3">Preço com IVA</th>
            <th class="px-4 py-3">PDF</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
        @foreach ($receipts->take(12) as $receipt)
            <tr class="text-gray-700 dark:text-gray-400">
                <td class="px-4 py-3">
                    <div class="flex items-center text-sm">
                        <p class="font-semibold">{{ $receipt->id }}</p>
                    </div>
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center text-sm">
                        <p class="font-semibold">{{ $receipt->data }}</p>
                    </div>
                </td>
                <td class="px-4 py-3 text-sm">
                    @switch($receipt->tipo_pagamento)
                        @case('Visa')
                            <span
                                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                Visa
                            </span>
                        @break

                        @case('Paypal')
                            <span
                                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                PayPal
                            </span>
                        @break

                        @default
                            <span
                                class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                                MBway
                            </span>
                    @endswitch
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center text-sm">
                        <p class="font-semibold">{{ $receipt->ref_pagamento }}</p>
                    </div>
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center text-sm">
                        <p class="font-semibold">
                            @if ($receipt->nif)
                                {{ $receipt->nif }}
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center text-sm">
                        <p class="font-semibold">{{ $receipt->preco_total_sem_iva . '€' }}</p>
                    </div>
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center text-sm">
                        <p class="font-semibold">{{ $receipt->iva . '%' }}</p>
                    </div>
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center text-sm">
                        <p class="font-semibold">{{ $receipt->preco_total_com_iva . '€' }}</p>
                    </div>
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center space-x-4 text-sm">
                        <button
                            class="flex items-center justify-between px-1 py-1 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-purple-500 focus:outline-none focus:shadow-outline-gray"
                            aria-label="PDF">
                            <svg class="w-5 h-5" data-darkreader-inline-stroke="" fill="none" stroke="currentColor"
                                style="--darkreader-inline-stroke: currentColor;" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
