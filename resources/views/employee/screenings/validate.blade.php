<x-dashboard.layout title="CineMagic - Controlo de Acesso" header="Controlo de Acesso à Sessão">
    @if (isset($alert))
        <div id="alert"
            class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-{{ $alert['alert-color'] ? $alert['alert-color'] : 'purple' }}-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple">
            <div class="flex items-center">
                @switch($alert['alert-icon'])
                    @case('success')
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @break

                    @case('error')
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @break

                    @case('warning')
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @break

                    @case('info')
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @break
                @endswitch

                <span class="ml-2">{{ $alert['alert-msg'] }}</span>
            </div>
            <button id="close-alert">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <script>
            const divAlert = document.getElementById("alert");
            const btnClose = document.getElementById("close-alert");
            btnClose.onclick = function() {
                if (divAlert.style.display !== "none") {
                    divAlert.style.display = "none";
                } else {
                    divAlert.style.display = "block";
                }
            };
        </script>
    @endif
    <div class="grid gap-6 mb-8 md:grid-cols-4">
        <div class="min-w-0 col-span-2 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="float-left mb-2 ml-3 text-2xl font-semibold dark:text-gray-200">Sessão #{{ $screening->id }}
            </div>
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
        @if (isset($ticket))
            <div class="min-w-0 col-span-2 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <x-tickets.client-data :ticket="$ticket" :email="false" />
                <div class="float-left ml-3 mt-2 -mb-2 text-2xl font-semibold dark:text-gray-200">Bilhete
                    #{{ $ticket->id }}
                </div>
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
                            <td class="px-4 py-3 font-bold">Lugar</td>
                            <td class="float-right px-4 py-3">{{ $ticket->seat->fila . $ticket->seat->posicao }}</td>
                        </tr>
                        <tr class="text-gray-700 dark:text-gray-400">
                            @if (isset($alert) && $alert['alert-icon'] == 'error')
                                <td class="px-4 pt-3 font-bold">Estado</td>
                                <td class="float-right px-4 pt-3">
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 dark:text-red-100 dark:bg-red-700 rounded-full">
                                        Usado
                                    </span>
                                </td>
                            @else
                                <td class="px-4 pt-3">
                                    <form method="post"
                                        action="{{ route('employee.screenings.validate.ticket', ['screening' => $screening, 'ticket' => $ticket]) }}">
                                        @csrf
                                        @method('PUT')
                                        <x-dashboard.button
                                            class="float-left button-primary bg-green-700 hover:bg-green-800">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <x-slot:label>Confirmar</x-slot:label>
                                        </x-dashboard.button>
                                    </form>
                                </td>
                                <td class="float-right px-4 pt-3">
                                    <form method="get"
                                        action="{{ route('employee.screenings.validate', ['screening' => $screening]) }}">
                                        <x-dashboard.button
                                            class="float-left button-primary bg-red-700 hover:bg-red-800">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            <x-slot:label>Cancelar</x-slot:label>
                                        </x-dashboard.button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    </tbody>
                </table>

            </div>
        @endif
    </div>
</x-dashboard.layout>
