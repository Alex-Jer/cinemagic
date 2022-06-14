<x-dashboard.layout title="Cinemagic - Comprar bilhete" header="Comprar bilhete">
    <x-dashboard.card-container class="{{ $seats->count() > 150 ? 'w-4/5' : ($seats->count() <= 80 ? 'w-1/2' : 'w-2/3') }}">
        <h2 class="mb-2 text-xl font-semibold text-gray-600 dark:text-gray-300">
            {{ $screening->film->titulo }}
        </h2>
        <span class="text-sm">
            Preço por bilhete:
            <span class="font-bold">
                {{ round($config->preco_bilhete_sem_iva + ($config->preco_bilhete_sem_iva * $config->percentagem_iva) / 100, 2) . '€' }}
            </span>
        </span>
        <div class="grid grid-cols-{{ $seats->max('posicao') + 2 }} mt-5">
            @foreach ($seats as $seat)
                @if ($seat->posicao == 1)
                    <div class="text-right pr-3 pt-3 font-semibold dark:text-gray-200 mr-2">
                        {{ $seat->fila }}
                    </div>
                @endif
                <form method="POST" action="{{ route('cart.store', [$screening, $seat]) }}">
                    @csrf
                    <button type="submit" class="">
                        {{-- {{ $seat->posicao . ' ' }} --}}
                        <svg class="w-12 h-12
                            {{ $seat->isOccupied($screening->id) ? 'fill-red-400' : ($seat->isInCart($screening->id) ? 'fill-green-400' : 'fill-gray-400') }}"
                            viewBox="0 0 512 512">
                            <path
                                d="M64 226.938V160C64 89.305 121.309 32 192 32H320C390.695 32 448 89.305 448 160V226.938C429.398 233.547 416 251.133 416 272V352H96V272C96 251.133 82.602 233.547 64 226.938Z"
                                class="fa-secondary" />
                            <path
                                d="M464 224C437.49 224 416 245.49 416 272V352H96V272C96 245.49 74.51 224 48 224S0 245.49 0 272V464C0 472.836 7.164 480 16 480H80C88.836 480 96 472.836 96 464V448H416V464C416 472.836 423.164 480 432 480H496C504.836 480 512 472.836 512 464V272C512 245.49 490.51 224 464 224Z"
                                class="fa-primary" />
                        </svg>
                    </button>
                </form>
                @if ($seat->posicao == $seats->max('posicao'))
                    <div class="pt-3 font-semibold dark:text-gray-200">
                        {{ $seat->fila }}
                    </div>
                @endif
            @endforeach
        </div>
        <div class="w-full block dark:text-gray-200 mt-4">
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
    </x-dashboard.card-container>
</x-dashboard.layout>
