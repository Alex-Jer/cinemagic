<x-dashboard.layout title="CineMagic - Filme">
    <div class="min-w-0 col-span-2 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <h2 class="mb-4 text-3xl font-semibold text-gray-700 uppercase dark:text-gray-200">
            {{ $film->titulo }}
        </h2>
        {{-- <div class="grid grid-flow-col grid-rows-3">
            <img class="w-3/5 h-auto row-span-3 rounded-lg" src="{{ asset('storage/cartazes/' . $film->cartaz_url) }}" alt="">
            <div class="col-span-2 -ml-64 text-2xl font-semibold uppercase">Sinopse</div>
            <div class="col-span-2 -ml-64 -mt-44">{{ $film->sumario }}</div>
            <div class="col-span-2 -ml-64 text-2xl font-semibold uppercase -mt-80">Sessões</div>
        </div> --}}
        <div class="grid grid-flow-col grid-rows-6 gap-4 auto-cols-max">
            <div class="w-56 row-span-6 h-80">
                @if ($film->cartaz_url)
                    <img class="w-full h-full rounded-lg" src="{{ asset('storage/cartazes/' . $film->cartaz_url) }}" alt="">
                @else
                    <img class="w-full h-full rounded-lg" src="https://i.imgur.com/eDZNyW3.jpg?width=460&height=676" alt="">
                @endif
            </div>
            <div class="col-span-2 text-2xl font-semibold uppercase6 dark:text-gray-200">Sinopse</div>
            <div class="col-span-2 row-span-2 -mt-4 dark:text-gray-400">{{ $film->sumario }}</div>
        </div>
    </div>
    <div class="min-w-0 col-span-2 p-4 mt-5 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="mb-2 ml-3 text-2xl font-semibold uppercase dark:text-gray-200">Sessões</div>
        <x-dashboard.screenings-table :film="$film" />
    </div>
</x-dashboard.layout>
