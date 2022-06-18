<x-dashboard.layout title="CineMagic - Recibo">
    <div class="w-2/5 col-span-2 p-4 mt-5 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="mb-2 ml-3 text-2xl font-semibold dark:text-gray-200">Bilhete #{{ $ticket->id }}</div>
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
                    <td class="px-4 py-3">ID</td>
                    <td class="px-4 py-3 float-right">{{ $ticket->id }}</td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">Data de compra</td>
                    <td class="px-4 py-3 float-right ">{{ $ticket->receipt->data->format('d/m/Y') }}</td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">Data da sessão</td>
                    <td class="px-4 py-3 float-right">{{ $ticket->screening->data->format('d/m/Y') }}</td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">Filme</td>
                    <td class="px-4 py-3 float-right">{{ $ticket->screening->film->titulo }}</td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">Sala</td>
                    <td class="px-4 py-3 float-right">{{ $ticket->screening->screen->nome }}</td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">Lugar</td>
                    <td class="px-4 py-3 float-right">{{ $ticket->seat->fila . $ticket->seat->posicao }}</td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">Nome</td>
                    <td class="px-4 py-3 float-right">{{ $ticket->customer->user->name }}</td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">Foto</td>
                    <td class="px-4 py-3 float-right">
                        <div class="relative hidden w-8 h-8 rounded-full md:block">
                            @if ($ticket->customer->user->foto_url)
                                <img class="object-cover w-full h-full rounded-full"
                                    src="{{ asset('storage/fotos/' . $ticket->customer->user->foto_url) }}"
                                    alt="{{ $ticket->customer->user->name }}" class="mt-2 mb-3 rounded-full w-9 h-9"
                                    loading="lazy">
                            @else
                                <img class="object-cover w-full h-full rounded-full"
                                    src="{{ asset('storage/fotos/default.png') }}" class="mt-2 mb-3 rounded-full w-9 h-9"
                                    loading="lazy">
                            @endif
                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-dashboard.layout>
