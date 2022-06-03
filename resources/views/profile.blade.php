<x-dashboard.layout>
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container grid px-6 mx-auto">

            <h4 class="my-6 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Perfil de {{ Auth::user()->name }}
            </h4>

            <x-dashboard.card>
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    <x-dashboard.input label="Nome" name="name" :placeholder="Auth::user()->name" attr="autofocus" />
                    <x-dashboard.input label="E-mail" name="email" :placeholder="Auth::user()->email" />
                    <span class="text-sm text-gray-700 dark:text-gray-400">Imagem de Perfil</span>
                    <div class="flex flex-row">
                        <x-dashboard.file-input />
                        @if (Auth::user()->foto_url)
                            <img src="{{ asset('storage/fotos/' . Auth::user()->foto_url) }}"
                                alt="{{ Auth::user()->name }}" class="w-9 h-9 mb-3 mt-2 rounded-full">
                        @else
                            <img src="{{ asset('storage/fotos/default.png') }}" alt="default profile picture"
                                class="w-9 h-9 mb-3 mt-2 rounded-full">
                        @endif
                        @if (Auth::user()->tipo == 'C')
                            <label class="block text-sm ml-6 -mt-4">
                                <span class="text-gray-700 dark:text-gray-400">NIF</span>
                                <input type="text" placeholder="{{ $cliente->nif }}" name="nif"
                                    class="block w-64 mt-1 text-sm placeholder-gray-400 border-gray-200 rounded-md dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 dark:text-gray-300">
                            </label>
                            <label class="block text-sm ml-6 -mt-4 h-full">
                                <span class="text-gray-700 dark:text-gray-400">Tipo de Pagamento</span>
                                <select
                                    class="block w-64 mt-1 text-sm placeholder-gray-400 border-gray-200 rounded-md dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 dark:text-gray-300"
                                    name="tipo_pagamento ">
                                    @foreach ($tiposPagamento as $tipo)
                                        <option value="{{ $tipo }}"
                                            {{ $cliente->tipo_pagamento == $tipo ? 'selected' : '' }}>
                                            {{ $tipo }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>

                            <label class="block text-sm ml-6 -mt-4">
                                <span class="text-gray-700 dark:text-gray-400">Referência de pagamento</span>
                                <input type="text" placeholder="{{ $cliente->ref_pagamento }}" name="ref_pagamento"
                                    class="block w-64 mt-1 text-sm placeholder-gray-400 border-gray-200 rounded-md dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 dark:text-gray-300">
                            </label>
                        @endif
                    </div>
                    <x-dashboard.button label="Guardar">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" aria-hidden="true" viewBox="0 0 448 512">
                            <path
                                d="M433.1 129.1l-83.9-83.9C342.3 38.32 327.1 32 316.1 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h320c35.35 0 64-28.65 64-64V163.9C448 152.9 441.7 137.7 433.1 129.1zM224 416c-35.34 0-64-28.66-64-64s28.66-64 64-64s64 28.66 64 64S259.3 416 224 416zM320 208C320 216.8 312.8 224 304 224h-224C71.16 224 64 216.8 64 208v-96C64 103.2 71.16 96 80 96h224C312.8 96 320 103.2 320 112V208z" />
                        </svg>
                    </x-dashboard.button>
                </form>
            </x-dashboard.card>

            <div class="grid gap-6 mb-8 md:grid-cols-2">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    <div class="min-w-0 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                            Dados Pessoais
                        </h4>
                        <p class="text-gray-600 dark:text-gray-400">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                            Fuga, cum commodi a omnis numquam quod? Totam exercitationem
                            quos hic ipsam at qui cum numquam, sed amet ratione! Ratione,
                            nihil dolorum.
                        </p>
                    </div>
                </form>
            </div>

        </div>
    </main>
</x-dashboard.layout>
