<x-dashboard.layout title="CineMagic - Recibo">
    <div class="w-2/5 col-span-2 px-4 pt-4 mt-5 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="mb-2 ml-3 text-2xl font-semibold dark:text-gray-200 float-left">Bilhete #{{ $ticket->id }}
        </div>
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-white border-b dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800">
                    <th class="invisible px-4 py-3"></th>
                    <th class="invisible px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 font-bold">Referência</td>
                    <td class="px-4 py-3 float-right">{{ $ticket->id }}</td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 font-bold">Data da sessão</td>
                    <td class="px-4 py-3 float-right">{{ $ticket->screening->data->format('j \d\e F \d\e Y') }}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 font-bold">Hora da sessão</td>
                    <td class="px-4 py-3 float-right">{{ $ticket->screening->horario_inicio->format('G:i') }}</td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 font-bold">Filme</td>
                    <td class="px-4 py-3 float-right">{{ $ticket->screening->film->titulo }}</td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 font-bold">Sala</td>
                    <td class="px-4 py-3 float-right">{{ $ticket->screening->screen->nome }}</td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 font-bold">Lugar</td>
                    <td class="px-4 py-3 float-right">{{ $ticket->seat->fila . $ticket->seat->posicao }}</td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 font-bold">Estado</td>
                    <td class="px-4 py-3 float-right">
                        <span
                            class="px-2 py-1 font-semibold leading-tight {{ $ticket->estado == 'usado' ? 'text-red-700 bg-red-100 dark:text-red-100 dark:bg-red-700' : 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' }}  rounded-full">
                            {{ $ticket->estado == 'usado' ? 'Usado' : 'Não Usado' }}
                        </span>
                    </td>
                </tr>
                <tr class="text-gray-500 dark:text-gray-600">
                    <td class="px-4 py-3">Data da compra</td>
                    <td class="float-right px-4 pt-3">
                        {{ $ticket->receipt->data->format('d/F/Y') }}</th>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="w-2/5 col-span-2 p-4 mt-5 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="mb-2 text-2xl font-semibold dark:text-gray-200 text-center">Dados do Cliente
        </div>
        <table class="w-full whitespace-no-wrap">
            <tbody class="bg-white dark:bg-gray-800">
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 float-left w-full flex">
                        <div class="relative hidden rounded-full md:block m-auto">
                            @if ($ticket->customer->user->foto_url)
                                <img class="object-cover rounded-full w-65 h-65"
                                    src="{{ asset('storage/fotos/' . $ticket->customer->user->foto_url) }}"
                                    alt="{{ $ticket->customer->user->name }}" class="mt-2 mb-3 rounded-full"
                                    loading="lazy">
                            @else
                                <img class="object-cover rounded-full w-65 h-65"
                                    src="{{ asset('storage/fotos/default.png') }}" class="mt-2 mb-3 rounded-full"
                                    loading="lazy">
                            @endif
                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-center text-xl">
                        {{ $ticket->customer->user->name }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-dashboard.layout>
