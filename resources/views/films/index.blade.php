<x-dashboard.layout title="CineMagic - Filmes" header="Filmes">
    <h4 class="mb-4 -mt-1 text-xl font-semibold text-gray-600 dark:text-gray-300">
        Em Cartaz
    </h4>

    <form method="GET" action="{{ route('films.index') }}" class="mb-3">
        <div class="container grid mx-auto">
            <div>
                <span class="float-left mr-2 -mt-1">
                    <x-dashboard.select label="Género" name="genre_code">
                        <option value="" {{ old('genre_code', $selectedGenre) === '' ? 'selected' : '' }}>Todos</option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->code }}"
                                {{ $genre->code === old('genre_code', $selectedGenre) ? 'selected' : '' }}>
                                {{ $genre->nome }}
                            </option>
                        @endforeach
                    </x-dashboard.select>
                </span>
                <span class="float-left -mt-1 mr-2 w-2/6">
                    <x-dashboard.input label="Pesquisa" name="search" placeholder="{{ old('search') }}" />
                </span>
                <x-dashboard.button class="button-primary float-left mt-5 mr-2">
                    <svg class="w-4 h-4 -ml-2 mr-0.5 mt-px" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <x-slot:label>Filtrar</x-slot:label>
                </x-dashboard.button>
                <x-dashboard.button-clear-params class="mt-5 float-left">
                    Limpar
                </x-dashboard.button-clear-params>
            </div>
        </div>
    </form>

    <div class="grid gap-6 mb-8">
        <div class="grid gap-x-14 mb-8 md:grid-cols-4 xl:grid-cols-5">
            @foreach ($films as $film)
                <a href="{{ 'films/' . $film->id }}" class="-mr-12">
                    <div
                        class="flex flex-wrap w-4/5 h-4/5 items-center justify-center mb-12 rounded-lg shadow-xs dark:bg-gray-800 transition ease-in-out hover:-translate-y-1 hover:scale-110 duration-100">
                        @if ($film->cartaz_url)
                            <img class="w-full h-full rounded-lg" src="{{ asset('storage/cartazes/' . $film->cartaz_url) }}"
                                alt="{{ $film->titulo }}">
                        @else
                            <img class="w-full h-full rounded-lg" src="https://i.imgur.com/eDZNyW3.jpg?width=460&height=676"
                                alt="{{ $film->titulo }}">
                        @endif
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
