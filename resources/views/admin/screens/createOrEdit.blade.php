<x-dashboard.layout title="CineMagic - Editar Sessão">
    <div class="grid gap-6 mb-8 grid-cols-5">
        <div class="min-w-0 p-4 col-span-1 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form method="POST" action="{{ route('admin.screens.update', $screen) }}">
                @csrf
                @method('PUT')
                <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                    Dados da sala
                </h4>
                <input type="hidden" name="filme_id" value="{{ $screen->id }}">
                <x-dashboard.inputfield label="Nome" name="nome" :value="$screen->nome" />
                <x-dashboard.inputfield label="Número de filas" name="filas" :value="$filas" />
                <x-dashboard.inputfield label="Número de posições" name="posicoes" :value="$posicoes" />
                <x-dashboard.button class="button-primary">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" aria-hidden="true" viewBox="0 0 448 512">
                        <path
                            d="M433.1 129.1l-83.9-83.9C342.3 38.32 327.1 32 316.1 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h320c35.35 0 64-28.65 64-64V163.9C448 152.9 441.7 137.7 433.1 129.1zM224 416c-35.34 0-64-28.66-64-64s28.66-64 64-64s64 28.66 64 64S259.3 416 224 416zM320 208C320 216.8 312.8 224 304 224h-224C71.16 224 64 216.8 64 208v-96C64 103.2 71.16 96 80 96h224C312.8 96 320 103.2 320 112V208z" />
                    </svg>
                    <x-slot:label>Guardar</x-slot:label>
                </x-dashboard.button>
            </form>
        </div>
    </div>
</x-dashboard.layout>
