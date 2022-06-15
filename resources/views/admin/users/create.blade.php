<x-dashboard.layout title="CineMagic - Criar Utilizador" header="Criar um Novo Utilizador">
    <div class="grid gap-6 mb-8 md:grid-cols-2">
        <div class="min-w-0 col-span-2 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                @csrf
                <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                    Dados pessoais
                </h4>
                <x-dashboard.input label="Nome" name="name" placeholder="Nome" attr="autofocus required" />
                <x-dashboard.input label="E-mail" name="email" placeholder="E-mail" attr="required" />
                <label class="block text-sm ">
                    <span class="dark:text-gray-400">Password</span>
                    <input class="mb-4 input-primary" name="password" type="password" placeholder="Password" required />
                </label>
                <label class="block text-sm ">
                    <span class="dark:text-gray-400">Confirmar password</span>
                    <input class="mb-4 input-primary" name="password_confirmation" type="password"
                        placeholder="Confirmar password" required />
                </label>

                <x-dashboard.select label="Tipo de utilizador" name="tipo_utilizador">
                    <option value='F' selected>
                        Funcionário
                    </option>
                    <option value='A'>
                        Administrador
                    </option>
                </x-dashboard.select>
                <span class="text-sm text-gray-700 dark:text-gray-400">Imagem de perfil</span>
                <div class="flex flex-row">
                    <x-dashboard.file-input name="profile_pic" />
                    <img src="{{ asset('storage/fotos/default.png') }}" alt="default profile picture"
                        class="mt-2 mb-3 rounded-full w-9 h-9">
                </div>
                <x-back-button class="mr-2" />
                <x-dashboard.button label="Criar" class="float-left">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                        </path>
                    </svg>
                </x-dashboard.button>


            </form>
        </div>
    </div>
</x-dashboard.layout>
