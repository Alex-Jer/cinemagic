<x-dashboard.layout>
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container grid px-6 mx-auto">

            <h4 class="my-6 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Perfil de {{ Auth::user()->name }}
            </h4>

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                <x-dashboard.form>
                    <x-dashboard.input label="Nome" name="name" :placeholder="Auth::user()->name" />
                    <x-dashboard.input label="E-mail" name="email" :placeholder="Auth::user()->email" />
                    <x-dashboard.button label="Guardar">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" aria-hidden="true" viewBox="0 0 448 512">
                            <path
                                d="M433.1 129.1l-83.9-83.9C342.3 38.32 327.1 32 316.1 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h320c35.35 0 64-28.65 64-64V163.9C448 152.9 441.7 137.7 433.1 129.1zM224 416c-35.34 0-64-28.66-64-64s28.66-64 64-64s64 28.66 64 64S259.3 416 224 416zM320 208C320 216.8 312.8 224 304 224h-224C71.16 224 64 216.8 64 208v-96C64 103.2 71.16 96 80 96h224C312.8 96 320 103.2 320 112V208z" />
                        </svg>
                    </x-dashboard.button>
                </x-dashboard.form>
            </form>

        </div>
    </main>
    </x-dashboard-layout>
