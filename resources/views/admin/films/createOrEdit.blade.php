<x-dashboard.layout :title="isset($film) ? 'CineMagic - Editar Filme' : 'Cinemagic - Adicionar Filme'" :header="isset($film) ? $film->titulo : 'Adicionar Filme'">
    <div class="flex w-full">
        <div class="min-w-0 w-1/2 col-span-2 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form method="POST" action="{{ isset($film) ? route('admin.films.update', $film) : route('admin.films.store') }}"
                enctype="multipart/form-data">
                @csrf
                @if (isset($film))
                    @method('PUT')
                @endif
                <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                    Dados do filme
                </h4>
                <x-dashboard.inputfield label="Título" name="titulo" :value="isset($film) ? $film->titulo : ''" :placeholder="isset($film) ? $film->titulo : ''" :attr="!Str::contains(Route::currentRouteName(), 'screening') ? 'autofocus' : 'readonly'" />
                <div class="flex flex-row space-x-4">
                    <x-dashboard.inputfield label="Ano" name="ano" type="number" :placeholder="isset($film) ? $film->ano : ''" :value="isset($film) ? $film->ano : ''"
                        :attr="!Str::contains(Route::currentRouteName(), 'screening') ? 'autofocus' : 'readonly'" />
                    @if (!Str::contains(Route::currentRouteName(), 'screening'))
                        <x-dashboard.select label="Género" name="genero_code">
                            <option {{ isset($film) ? ($film->genre ? '' : 'selected') : 'selected' }} disabled>Género</option>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->code }}"
                                    {{ isset($film) ? ($film->genero_code == $genre->code ? 'selected' : '') : '' }}>
                                    {{ $genre->nome }}
                                </option>
                            @endforeach
                        </x-dashboard.select>
                    @else
                        <x-dashboard.inputfield label="Género" name="genero_code" :value="isset($film) ? $film->genre->nome : ''" :placeholder="isset($film) ? $film->genre->nome : ''"
                            :attr="!Str::contains(Route::currentRouteName(), 'screening') ? 'autofocus' : 'readonly'" />
                    @endif
                    @if (!Str::contains(Route::currentRouteName(), 'screening'))
                        <x-dashboard.file-input label="Cartaz" name="cartaz" />
                    @endif
                </div>
                <x-dashboard.inputfield label="Trailer" name="trailer_url" :placeholder="isset($film) ? $film->trailer_url : ''" :value="isset($film) ? $film->trailer_url : ''" />
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Message</span>
                    <textarea name="sumario" class="input-primary" rows="3">{{ isset($film) ? $film->sumario : '' }}</textarea>
                </label>
                @if (!Str::contains(Route::currentRouteName(), 'screening'))
                    <x-dashboard.button class="button-primary mt-4">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" aria-hidden="true" viewBox="0 0 448 512">
                            <path
                                d="M433.1 129.1l-83.9-83.9C342.3 38.32 327.1 32 316.1 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h320c35.35 0 64-28.65 64-64V163.9C448 152.9 441.7 137.7 433.1 129.1zM224 416c-35.34 0-64-28.66-64-64s28.66-64 64-64s64 28.66 64 64S259.3 416 224 416zM320 208C320 216.8 312.8 224 304 224h-224C71.16 224 64 216.8 64 208v-96C64 103.2 71.16 96 80 96h224C312.8 96 320 103.2 320 112V208z" />
                        </svg>
                        <x-slot:label>Guardar</x-slot:label>
                    </x-dashboard.button>
                @endif
            </form>
        </div>

        <div class="min-w-0 p-4 ml-5 h-72 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form method="POST" action="{{ route('admin.screenings.store') }}">
                @csrf
                <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                    Adicionar sessão
                </h4>
                <input type="hidden" name="filme_id" value="{{ $film->id }}">
                <x-dashboard.select label="Sala" name="sala_id">
                    <option selected disabled>Sala</option>
                    @foreach ($screens as $screen)
                        <option value="{{ $screen->id }}">
                            {{ $screen->nome }}
                        </option>
                    @endforeach
                </x-dashboard.select>
                <div class="flex flex-row mb-4 space-x-4">
                    <x-dashboard.date-input label="Data" name="data" value="{{ old('data') }}" />
                    <x-dashboard.time-input label="Hora" name="horario_inicio" value="{{ old('horario_inicio') }}" />
                </div>
                <x-dashboard.button class="button-primary mt-6">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                            clip-rule="evenodd">
                        </path>
                    </svg>
                    <x-slot:label>Adicionar Sessão</x-slot:label>
                </x-dashboard.button>
            </form>
        </div>
    </div>
</x-dashboard.layout>
