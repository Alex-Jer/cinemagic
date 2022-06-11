<x-dashboard.layout title="CineMagic - Filmes" header="Filmes">
    <h4 class="mb-6 -mt-1 text-xl font-semibold text-gray-600 dark:text-gray-300">
        Em Cartaz
    </h4>
    <div class="grid gap-6 mb-8">
        <div class="grid gap-x-14 mb-8 md:grid-cols-4 xl:grid-cols-5">
            @foreach ($films as $film)
                <a href="{{ 'films/' . $film->id }}" class="-mr-12">
                    <div
                        class="flex flex-wrap w-4/5 h-4/5 items-center justify-center mb-12 rounded-lg shadow-xs dark:bg-gray-800 transition ease-in-out hover:-translate-y-1 hover:scale-110 duration-100">
                        <img class="w-full h-full rounded-lg" src="{{ asset('storage/cartazes/' . $film->cartaz_url) }}"
                            alt="{{ $film->titulo }}">
                        <h4 class="mt-2 font-semibold text-center text-gray-600 text-md dark:text-gray-300">
                            {{ $film->titulo }}
                        </h4>
                    </div>
                </a>
            @endforeach
        </div>
        {{ $films->onEachSide(1)->links() }}
    </div>
</x-dashboard.layout>
