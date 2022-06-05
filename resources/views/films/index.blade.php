<x-dashboard.layout title="Filmes">
    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-5">
        {{-- TODO: Remover take() e otimizar consulta --}}
        @foreach ($films->take(15) as $film)
            <div class="flex flex-wrap items-center mb-8 rounded-lg shadow-xs dark:bg-gray-800">
                <img class="w-full h-full" src="{{ asset('storage/cartazes/' . $film->cartaz_url) }}"
                    alt="{{ $film->titulo }}">
                <div class="text-base text-center">
                    {{ $film->titulo }}
                </div>
            </div>
        @endforeach
    </div>
</x-dashboard.layout>
