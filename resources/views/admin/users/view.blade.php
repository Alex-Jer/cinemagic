<x-dashboard.layout :title="'CineMagic - ' . $user->name" :header="'Perfil de ' . $user->name">
    <div class="grid gap-6 mb-8 {{ $customer ? 'md:grid-cols-3' : 'md:grid-cols-2' }}">
        <div class="min-w-0 col-span-2 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form method="POST" action="{{ route('admin.users.update', ['user' => $user]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                    Dados pessoais
                </h4>
                <x-dashboard.view-user.input label="Nome" name="name" :content="$user->name" attr="autofocus"
                    :mode="$mode" />
                <x-dashboard.view-user.input label="E-mail" name="email" :content="$user->email" :mode="$mode" />
                <span class="text-sm text-gray-700 dark:text-gray-400">Imagem de perfil</span>
                <div class="flex flex-row">
                    @if ($mode == 'edit')
                        <x-dashboard.file-input name="profile_pic" />
                    @endif
                    @if ($user->foto_url)
                        <img src="{{ asset('storage/fotos/' . $user->foto_url) }}" alt="{{ $user->name }}"
                            class="mt-2 mb-3 rounded-full w-9 h-9">
                    @else
                        <img src="{{ asset('storage/fotos/default.png') }}" alt="default profile picture"
                            class="mt-2 mb-3 rounded-full w-9 h-9">
                    @endif
                </div>

                @if ($mode == 'edit')
                    <x-dashboard.button label="Guardar">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" aria-hidden="true" viewBox="0 0 448 512">
                            <path
                                d="M433.1 129.1l-83.9-83.9C342.3 38.32 327.1 32 316.1 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h320c35.35 0 64-28.65 64-64V163.9C448 152.9 441.7 137.7 433.1 129.1zM224 416c-35.34 0-64-28.66-64-64s28.66-64 64-64s64 28.66 64 64S259.3 416 224 416zM320 208C320 216.8 312.8 224 304 224h-224C71.16 224 64 216.8 64 208v-96C64 103.2 71.16 96 80 96h224C312.8 96 320 103.2 320 112V208z" />
                        </svg>
                    </x-dashboard.button>
                @endif
            </form>
        </div>
        @if ($user->tipo == 'C')
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <form method="POST" action="{{ route('admin.users.update', ['user' => $user]) }}">
                    @csrf
                    @method('PUT')
                    <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                        Dados de pagamento
                    </h4>

                    <x-dashboard.view-user.input label="NIF" name="nif" :content="$customer->nif ? $customer->nif : 'NIF'" :mode="$mode" />
                    @if ($mode == 'edit')
                        <x-dashboard.select label="Tipo de pagamento" name="tipo_pagamento">
                            <option {{ $customer->tipo_pagamento ? '' : 'selected' }} disabled>Tipo de pagamento
                            </option>
                            @foreach ($paymentTypes as $tipo)
                                <option value="{{ $tipo }}"
                                    {{ $customer->tipo_pagamento == $tipo ? 'selected' : '' }}>
                                    {{ $tipo }}
                                </option>
                            @endforeach
                        </x-dashboard.select>
                    @else
                        <x-dashboard.view-user.input label="Tipo de pagamento" name="tipo_pagamento" :content="$customer->tipo_pagamento"
                            :mode="$mode" />
                    @endif
                    <x-dashboard.view-user.input label="Referência de pagamento" name="ref_pagamento" :content="$customer->tipo_pagamento ? $customer->ref_pagamento : 'Referência de pagamento'"
                        :mode="$mode" />
                    @if ($mode == 'edit')
                        <x-dashboard.button label="Guardar">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" aria-hidden="true" viewBox="0 0 448 512">
                                <path
                                    d="M433.1 129.1l-83.9-83.9C342.3 38.32 327.1 32 316.1 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h320c35.35 0 64-28.65 64-64V163.9C448 152.9 441.7 137.7 433.1 129.1zM224 416c-35.34 0-64-28.66-64-64s28.66-64 64-64s64 28.66 64 64S259.3 416 224 416zM320 208C320 216.8 312.8 224 304 224h-224C71.16 224 64 216.8 64 208v-96C64 103.2 71.16 96 80 96h224C312.8 96 320 103.2 320 112V208z" />
                            </svg>
                        </x-dashboard.button>
                    @endif
                </form>
            </div>
        @endif
    </div>
</x-dashboard.layout>
