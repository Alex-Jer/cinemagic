<x-dashboard.layout title="CineMagic - Filme" :header="$film->titulo">
    <img class="w-1/6 h-full rounded-lg" src="{{ asset('storage/cartazes/' . $film->cartaz_url) }}" alt="">
    <p class="dark:text-white"> {{ $film->sumario }} </p>
    <p class="dark:text-white"> {{ $film->trailer_url }} </p>
    <p class="dark:text-white text-xs"> ID: {{ $film->id }} </p>
    <p class="dark:text-white text-xs"> Género: {{ $film->genre->nome }} </p>
    <p class="dark:text-white">***</p>
    @foreach ($film->screenings as $screening)
        @if ($screening->data . $screening->horario_inicio >= now())
            <div class="dark:text-white">
                <p>{{ 'Sala: ' . $screening->screen->nome }}</p>
                <p>{{ $screening->data . ' às ' . $screening->horario_inicio }}</p>
                <p>***</p>
            </div>
        @endif
    @endforeach
    <form method="POST" action="{{ route('cart.add', ['film' => $film]) }}" class="mt-3">
        @csrf
        <x-dashboard.button label="Comprar bilhete">
            <svg class="w-4 h-4 mr-2" fill="currentColor" aria-hidden="true" viewBox="0 0 448 512">
                <path
                    d="M433.1 129.1l-83.9-83.9C342.3 38.32 327.1 32 316.1 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h320c35.35 0 64-28.65 64-64V163.9C448 152.9 441.7 137.7 433.1 129.1zM224 416c-35.34 0-64-28.66-64-64s28.66-64 64-64s64 28.66 64 64S259.3 416 224 416zM320 208C320 216.8 312.8 224 304 224h-224C71.16 224 64 216.8 64 208v-96C64 103.2 71.16 96 80 96h224C312.8 96 320 103.2 320 112V208z" />
            </svg>
        </x-dashboard.button>
    </form>
</x-dashboard.layout>
