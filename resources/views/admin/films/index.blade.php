<x-dashboard.layout title="CineMagic - Gestão de Filmes" header="Gestão de Filmes">
    <form method="GET" action="{{ route('admin.films.index') }}" class="mb-3">
        <div class="container grid mx-auto">
            <div>
                <span class="float-left mr-2 -mt-1">
                    <x-dashboard.select label="Género" name="genre_code">
                        <option value="" {{ old('genre_code', $selectedGenre) === '' ? 'selected' : '' }}>Todos
                        </option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->code }}"
                                {{ $genre->code === old('genre_code', $selectedGenre) ? 'selected' : '' }}>
                                {{ $genre->nome }}
                            </option>
                        @endforeach
                    </x-dashboard.select>
                </span>
                <span class="float-left w-2/6 mr-2 -mt-1">
                    <x-dashboard.inputfield label="Pesquisa" name="search"
                        value="{{ old('search', $search) === '' ? 'Pesquise um filme por título ou sumário' : old('search', $search) }}" />

                </span>
                <x-dashboard.button class="float-left mt-5 mr-2 button-primary">
                    <svg class="w-4 h-4 -ml-2 mr-0.5 mt-px" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <x-slot:label>Filtrar</x-slot:label>
                </x-dashboard.button>
                <x-dashboard.button-clear-params class="float-left mt-5">
                    Limpar
                </x-dashboard.button-clear-params>
            </div>
        </div>
    </form>
    <div class="w-full overflow-hidden rounded-lg shadow-md">
        <div class="w-full overflow-x-auto">
            <x-dashboard.films-table :films="$films" />
        </div>
        {{ $films->onEachSide(2)->links() }}
    </div>
</x-dashboard.layout>
