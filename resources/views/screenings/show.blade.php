<style>
    .grid-cols-20 {
        grid-template-columns: repeat(20, minmax(0, 1fr))
    }

    .grid-cols-15 {
        grid-template-columns: repeat(15, minmax(0, 1fr))
    }
</style>

<x-dashboard.layout title="Cinemagic - Comprar bilhete" header="Comprar bilhete">
    <x-dashboard.card-container>
        <div class="grid gap-1 grid-cols-20 grid-cols-{{ $seats->max('posicao') }}">
            @foreach ($seats as $seat)
                <form method="POST" action="{{ route('cart.store', [$screening, $seat]) }}">
                    @csrf
                    <button type="submit" class="w-full">
                        <div class="outline">
                            @if ($seat->posicao === 1)
                                {{ $seat->fila . ' ' . $seat->posicao }}
                            @else
                                {{ $seat->posicao }}
                            @endif
                        </div>
                    </button>
                </form>
            @endforeach
        </div>
    </x-dashboard.card-container>
</x-dashboard.layout>
