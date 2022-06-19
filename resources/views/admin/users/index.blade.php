<x-dashboard.layout title="CineMagic - Utilizadores" header="Gestão de Utilizadores">
    <div class="container grid mx-auto">
        <div>
            <form method="GET" action="{{ route('admin.users.index') }}" class="mb-3">
                <span class="float-left mr-2 -mt-1">
                    <x-dashboard.select label="Tipo de Utilizador" name="user_type">
                        @if (count($tipos) >= 2)
                            <option value="" {{ old('user_type', $selectedType) === '' ? 'selected' : '' }}>Todos
                            </option>
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo }}"
                                    {{ $tipo === old('user_type', $selectedType) ? 'selected' : '' }}>
                                    @switch($tipo)
                                        @case('A')
                                            Administrador
                                        @break

                                        @case('F')
                                            Funcionário
                                        @break

                                        @default
                                            Cliente
                                        @break
                                    @endswitch
                                </option>
                            @endforeach
                        @else
                            <option value="C" selected>Cliente
                            </option>
                        @endif
                    </x-dashboard.select>
                </span>
                <span class="float-left w-2/6 mr-2 -mt-1">
                    <x-dashboard.inputfield label="Pesquisa por nome" name="search"
                        value="{{ old('search', $search) === '' ? '' : old('search', $search) }}"
                        placeholder="Pesquise um utilizador pelo seu nome" />

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
            @can('create', App\Models\User::class)
                <form method="GET" action="{{ route('admin.users.create') }}">
                    <x-dashboard.button class="float-left mt-2 mb-3 button-primary">
                        <svg class="w-4 h-4 -ml-2 mr-0.5 mt-px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                            </path>
                        </svg>
                        <x-slot:label>Criar</x-slot:label>
                    </x-dashboard.button>
                </form>
            @endcan
        </div>
    </div>
    <div class="w-full overflow-hidden rounded-lg shadow-md">
        <div class="w-full overflow-x-auto">
            <x-dashboard.users-table :users="$users" />
        </div>
        {{ $users->onEachSide(2)->links() }}
    </div>
</x-dashboard.layout>
