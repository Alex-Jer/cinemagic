<x-dashboard.layout title="CineMagic - Filme">
    <div class="min-w-0 col-span-2 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <h2 class="mb-4 text-3xl uppercase font-semibold text-gray-700 dark:text-gray-200">
            {{ $film->titulo }}
        </h2>
        {{-- <div class="grid grid-rows-3 grid-flow-col">
            <img class="row-span-3 w-3/5 h-auto rounded-lg" src="{{ asset('storage/cartazes/' . $film->cartaz_url) }}" alt="">
            <div class="col-span-2 -ml-64 text-2xl uppercase font-semibold">Sinopse</div>
            <div class="col-span-2 -ml-64 -mt-44">{{ $film->sumario }}</div>
            <div class="col-span-2 -ml-64 -mt-80 text-2xl uppercase font-semibold">Sessões</div>
        </div> --}}
        <div class="grid grid-rows-6 grid-flow-col gap-4">
            {{-- <div class="row-span-6 w-4/5 h-auto bg-cover rounded-lg"
                style="background-image: url({{ asset('storage/cartazes/' . $film->cartaz_url) }})">
            </div> --}}
            <img class="row-span-6 w-3/6 h-auto rounded-lg -mr-48" src="{{ asset('storage/cartazes/' . $film->cartaz_url) }}"
                alt="">
            <div class="col-span-2 -ml-96 text-2xl font-semibold uppercase">Sinopse</div>
            <div class="row-span-2 -ml-96 col-span-2 -mt-14">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</div>
        </div>
    </div>
    <div class="min-w-0 col-span-2 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800 mt-5">
        <div class="text-2xl font-semibold uppercase ml-3 mb-2">Sessões</div>
        <x-dashboard.screenings-table :film="$film" />
    </div>
</x-dashboard.layout>
