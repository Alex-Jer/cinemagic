<style>
    .grid-cols-22 {
        grid-template-columns: repeat(22, minmax(0, 1fr))
    }

    .grid-cols-17 {
        grid-template-columns: repeat(17, minmax(0, 1fr))
    }
</style>

<x-dashboard.layout title="Cinemagic - Comprar bilhete" header="Comprar bilhete">
    <x-dashboard.card-container>
        <div class="grid gap-1 grid-cols-20 grid-cols-{{ $seats->max('posicao') + 2 }}">
            @foreach ($seats as $seat)
                @if ($seat->posicao == 1)
                    <span type="submit" class="w-full">
                        <div class="outline text-right pr-2">
                            Fila {{ $seat->fila }}
                        </div>
                    </span>
                @endif
                <form method="POST" action="{{ route('cart.store', [$screening, $seat]) }}">
                    @csrf
                    <button type="submit"
                        class="w-full
                    {{ $seat->isOccupied($screening->id) ? 'bg-red-400' : '' }}
                    {{ $seat->isInCart($screening->id) ? 'bg-green-400' : '' }}">
                        <div class="outline">
                            {{ $seat->posicao . ' ' }}
                        </div>
                    </button>
                </form>
                @if ($seat->posicao == $seats->max('posicao'))
                    <span type="submit" class="w-full">
                        <div class="outline pl-2">
                            Fila {{ $seat->fila }}
                        </div>
                    </span>
                @endif
            @endforeach
        </div>
        <div class="w-full block">
            <div class="float-left text-sm">
                Capacidade:
                <span class="font-bold">{{ $seats->count() }}</span>
            </div>
            <div class="float-right ">
                Lugares livres:
                <span class="font-bold">
                    {{ $seats->count() - $occupied }}
                </span>
            </div>
        </div>
    </x-dashboard.card-container>
</x-dashboard.layout>
