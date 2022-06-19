<x-dashboard.layout title="CineMagic - Controlo de Acesso" header="Controlo de Acesso à Sessão">
    <div class="grid gap-6 mb-8 md:grid-cols-4">
        <div class="min-w-0 col-span-2 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="float-left mb-2 ml-3 text-2xl font-semibold dark:text-gray-200">Sessão #{{ $screening->id }}
            </div>
            {{ Debugbar::debug(session()) }}
            {{ Debugbar::debug(session('alert-msg')) }}
            <x-back-button class="float-right mr-3" />
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-white border-b dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800">
                        <th class="invisible px-4 py-3"></th>
                        <th class="invisible px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 font-bold">Filme</td>
                        <td class="float-right px-4 py-3">{{ $screening->film->titulo }}</td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 font-bold">Data</td>
                        <td class="float-right px-4 py-3">{{ $screening->data->translatedFormat('j \d\e F \d\e Y') }}
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 font-bold">Hora</td>
                        <td class="float-right px-4 py-3">{{ $screening->horario_inicio->format('G:i') }}</td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 font-bold">Sala</td>
                        <td class="float-right px-4 py-3">{{ $screening->screen->nome }}</td>
                    </tr>
                    <form method="GET"
                        action="{{ route('employee.screenings.validate', ['screening' => $screening]) }}">
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 font-bold">Bilhete</td>
                            <td class="float-right px-4 py-2">
                                <div class="block text-sm ">
                                    <input class="input-primary" type="text" name="ticket"
                                        placeholder="Referência do Bilhete" autofocus required>
                                </div>
                            </td>
                        </tr>
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="invisible px-4 py-3 font-bold"></td>
                            <td class="float-right px-4 pt-3">
                                <x-dashboard.button class="float-left button-primary">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                        </path>
                                    </svg>
                                    <x-slot:label>Validar bilhete</x-slot:label>
                                </x-dashboard.button>
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard.layout>
