<x-dashboard.layout title="Cinemagic - Detalhes da Sessão">
    <div class="grid gap-6 mb-8 md:grid-cols-4">
        <div class="min-w-0 col-span-2 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="float-left mb-2 ml-3 text-2xl font-semibold dark:text-gray-200">Sessão #{{ $screening->id }}</div>
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
                        <td class="px-4 py-3 font-bold">Filme</td>
                        <td class="float-right px-4 py-3">{{ $screening->film->titulo }}</td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 font-bold">Data</td>
                        <td class="float-right px-4 py-3">{{ $screening->data }}</td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 font-bold">Hora</td>
                        <td class="float-right px-4 py-3">{{ $screening->horario_inicio }}</td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 font-bold">Sala</td>
                        <td class="float-right px-4 py-3">{{ $screening->screen->nome }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="{{ $seats->count() > 150 ? 'w-4/5' : ($seats->count() <= 80 ? 'w-1/2' : 'w-2/3') }}">
        <div class="min-w-0 col-span-1 p-4 pb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <h2 class="mb-2 text-xl font-semibold text-gray-600 dark:text-gray-300">
                Lugares ocupados
            </h2>

            <div class="grid grid-cols-{{ $seats->max('posicao') + 2 }} mt-5">
                @foreach ($seats as $seat)
                    @if ($seat->posicao == 1)
                        <div class="pt-3 pr-3 mr-2 font-semibold text-right dark:text-gray-200">
                            {{ $seat->fila }}
                        </div>
                    @endif
                    <svg class="w-12 h-12
                            {{ $seat->isOccupied($screening->id) ? 'fill-red-400' : ($seat->isInCart($seat->id) ? 'fill-green-400' : 'fill-gray-400') }}"
                        viewBox="0 0 512 512">
                        <path
                            d="M64 226.938V160C64 89.305 121.309 32 192 32H320C390.695 32 448 89.305 448 160V226.938C429.398 233.547 416 251.133 416 272V352H96V272C96 251.133 82.602 233.547 64 226.938Z"
                            class="fa-secondary" />
                        <path
                            d="M464 224C437.49 224 416 245.49 416 272V352H96V272C96 245.49 74.51 224 48 224S0 245.49 0 272V464C0 472.836 7.164 480 16 480H80C88.836 480 96 472.836 96 464V448H416V464C416 472.836 423.164 480 432 480H496C504.836 480 512 472.836 512 464V272C512 245.49 490.51 224 464 224Z"
                            class="fa-primary" />
                    </svg>
                    @if ($seat->posicao == $seats->max('posicao'))
                        <div class="pt-3 font-semibold dark:text-gray-200">
                            {{ $seat->fila }}
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="block w-full mt-4 dark:text-gray-200">
                <div class="float-left text-sm">
                    Capacidade:
                    <span class="font-bold">{{ $seats->count() }}</span>
                </div>
                <div class="float-right text-sm">
                    Lugares livres:
                    <span class="font-bold">
                        {{ $seats->count() - $occupied }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
