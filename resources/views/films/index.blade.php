<x-dashboard.layout title="Em cartaz">
    <div class="grid gap-6 mb-8 md:grid-cols-4 xl:grid-cols-5">
        {{-- TODO: Remover take() e otimizar consulta --}}
        @foreach ($films->take(15) as $film)
            <div class="flex flex-wrap items-center justify-center mb-12 rounded-lg shadow-xs dark:bg-gray-800">
                <img class="w-full h-full rounded-lg" src="{{ asset('storage/cartazes/' . $film->cartaz_url) }}"
                    alt="{{ $film->titulo }}">
                <h4 class="mt-2 font-semibold text-center text-gray-600 text-md dark:text-gray-300">
                    {{ $film->titulo }}
                </h4>
            </div>
        @endforeach
    </div>
</x-dashboard.layout>
