<x-dashboard.layout title="CineMagic - Utilizadores" header="Gestão de Utilizadores">
    <div class="container grid mx-auto">
        <div>
            <form method="GET" action="{{ route('admin.users.index') }}" class="mb-3">
                <span class="float-left mr-2 -mt-1">
                    <x-dashboard.select label="Tipo de Utilizador" name="user_type">
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
                        <svg class="w-5 h-5 mr-1 -ml-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z">
                            </path>
                        </svg>
                        <x-slot:label>Novo Utilizador</x-slot:label>
                    </x-dashboard.button>
                </form>
            @endcan
        </div>
    </div>
    <div class="w-full overflow-hidden rounded-lg shadow-md">
        <div class="w-full overflow-x-auto">
            <x-dashboard.users-table :users="$users" :authUser="$authUser" />
        </div>
        {{ $users->appends(request()->all())->onEachSide(2)->links() }}
    </div>
</x-dashboard.layout>
