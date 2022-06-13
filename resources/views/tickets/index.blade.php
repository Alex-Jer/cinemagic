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
        <div class="grid gap-1 grid-cols-20">
            @foreach ($seats as $seat)
                @if ($seat['col'] == 1)
                    <div class="outline">{{ $seat['row'] . ' ' . $seat['col'] }}</div>
                @else
                    <div class="outline">{{ $seat['col'] }}</div>
                @endif
            @endforeach
        </div>
    </x-dashboard.card-container>
</x-dashboard.layout>
