<x-dashboard.layout title="CineMagic - Gestão de Filmes" header="Gestão de Filmes">
    <div class="container grid mx-auto">
        <div>
            <form method="GET" action="{{ route('admin.films.index') }}" class="mb-6">
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
                <span class="float-left w-2/6 mr-2 -mt-1">
                    <x-dashboard.inputfield label="Pesquisa" name="search"
                        value="{{ old('search', $search) === '' ? '' : old('search', $search) }}"
                        placeholder="Pesquise um filme por título ou sumário" />
                </span>
                <x-dashboard.button class="float-left mt-5 mr-2 button-primary">
                    <svg class="w-4 h-4 -ml-2 mr-0.5 mt-px" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <x-slot:label>Filtrar</x-slot:label>
                </x-dashboard.button>
                <x-dashboard.button-clear-params class="float-left mt-5 mr-2">
                    Limpar
                </x-dashboard.button-clear-params>
            </form>
            <form method="GET" action="{{ route('admin.films.create') }}" class="mb-3">
                <x-dashboard.button class="float-right -mt-1 button-primary">
                    <svg class="w-4 h-4 -ml-2 mr-0.5 mt-px" data-darkreader-inline-fill="" fill="currentColor"
                        style="--darkreader-inline-fill: currentColor;" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <x-slot:label>Novo Filme</x-slot:label>
                </x-dashboard.button>
            </form>
        </div>
    </div>
    <div class="w-full overflow-hidden rounded-lg shadow-md">
        <div class="w-full overflow-x-auto">
            <x-dashboard.films-table :films="$films" />
        </div>
        {{ $films->appends(request()->all())->onEachSide(2)->links() }}
    </div>
</x-dashboard.layout>
