<script src="{{ asset('js/focus-trap.js') }}" defer></script>
<table class="w-full whitespace-no-wrap table-fixed">
    <thead>
        <tr
            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-white dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3 w-3/5">Utilizador</th>
            <th class="px-4 py-3">Tipo</th>
            <th class="px-4 py-3">Estado</th>
            <th class="px-4 py-3 text-center w-2/12">Ações</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
        @foreach ($users as $user)
            <tr
                class="text-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition ease-in-out duration-100">
                <td class="px-4 py-3">
                    <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                            @if ($user->foto_url)
                                <img class="object-cover w-full h-full rounded-full"
                                    src="{{ asset('storage/fotos/' . $user->foto_url) }}" alt="{{ $user->name }}"
                                    class="mt-2 mb-3 rounded-full w-9 h-9" loading="lazy">
                            @else
                                <img class="object-cover w-full h-full rounded-full"
                                    src="{{ asset('storage/fotos/default.png') }}"
                                    class="mt-2 mb-3 rounded-full w-9 h-9" loading="lazy">
                            @endif

                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                        <div>
                            <p class="font-semibold">
                                @can('view', $user)
                                    <a href="{{ route('admin.users.show', ['user' => $user]) }}">{{ $user->name }}</a>
                                @else
                                    {{ $user->name }}
                                @endcan
                            </p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-4 py-3 text-sm font-medium">
                    @switch($user->tipo)
                        @case('A')
                            Administrador
                        @break

                        @case('F')
                            Funcionário
                        @break

                        @default
                            Cliente
                    @endswitch
                </td>
                <td class="px-4 py-3 text-xs">
                    <span
                        class="px-2 py-1 font-semibold leading-tight {{ $user->bloqueado ? 'text-red-700 bg-red-100 dark:text-red-100 dark:bg-red-700' : 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' }}  rounded-full">
                        {{ $user->bloqueado ? 'Bloqueado' : 'Ativo' }}
                    </span>
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center space-x-2 text-sm">
                        <form method="GET" action="{{ route('admin.users.show', ['user' => $user]) }}">
                            <button title="Ver perfil"
                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 rounded-lg
                                @can('view', $user)
                                    {{'text-purple-600 dark:text-gray-400'}}
                                @else
                                    {{'text-purple-400 dark:text-gray-600' }} 
                                @endcan
                                focus:outline-none focus:shadow-outline-gray"
                                aria-label="Edit"
                                @cannot('view', $user)
                                    {{ 'disabled' }}
                                @endcan>
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </button>
                        </form>
                        <form method="GET" action="{{ route('admin.users.edit', ['user' => $user]) }}">
                            <button  title="Editar perfil"
                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 rounded-lg
                                @can('update', $user)
                                    {{'text-purple-600 dark:text-gray-400'}} 
                                @else
                                    {{'text-purple-400 dark:text-gray-600' }} 
                                @endcan 
                                focus:outline-none focus:shadow-outline-gray"
                                aria-label="Edit"
                                @cannot('update', $user)
                                    {{ 'disabled' }}
                                @endcan>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                    </path>
                                </svg>
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.users.toggleblock', ['user' => $user]) }}">
                            @csrf
                            @method('PUT')
                            <button title="{{$user->bloqueado?"Desbloquear":"Bloquear"}} utilizador"
                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 rounded-lg
                                @can('block', $user)
                                    {{'text-purple-600 dark:text-gray-400'}}
                                @else
                                    {{'text-purple-400 dark:text-gray-600' }}
                                @endcan
                                focus:outline-none focus:shadow-outline-gray"
                                aria-label="Edit"
                                @cannot('block', $user)
                                    {{ 'disabled' }}
                                @endcan>
                                @if ($user->bloqueado)
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                @endif
                                </button>
                        </form>
                        <form method="POST" action="{{ route('admin.users.destroy', ['user' => $user]) }}">
                            @csrf
                            @method('DELETE')
                            <button title="Apagar utilizador"
                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 rounded-lg
                                @can('delete', $user)
                                    {{'text-purple-600 dark:text-gray-400'}}
                                @else
                                    {{'text-purple-400 dark:text-gray-600' }}
                                @endcan
                                focus:outline-none focus:shadow-outline-gray"
                                aria-label="Delete" type="submit"
                                @cannot('delete', $user)
                                    {{ 'disabled' }}
                                @endcan>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
