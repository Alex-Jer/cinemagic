<div class="mb-3 text-2xl font-semibold text-center dark:text-gray-200">Dados do Cliente</div>
<table class="w-full whitespace-no-wrap">
    <tbody class="bg-white dark:bg-gray-800">
        <tr class="text-gray-700 dark:text-gray-400">
            <td class="flex float-left w-full px-4 py-3">
                <div class="relative hidden m-auto rounded-full md:block">
                    @if ($ticket->customer->user->foto_url)
                        <img class="object-cover rounded-full w-70 h-70"
                            src="{{ asset('storage/fotos/' . $ticket->customer->user->foto_url) }}"
                            alt="{{ $ticket->customer->user->name }}" class="mt-2 mb-3 rounded-full" loading="lazy">
                    @else
                        <img class="object-cover rounded-full w-70 h-70" src="{{ asset('storage/fotos/default.png') }}"
                            class="mt-2 mb-3 rounded-full" loading="lazy">
                    @endif
                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                </div>
            </td>
        </tr>
        <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-xl text-center">
                {{ $ticket->customer->user->name }}
            </td>
        </tr>
        @if ($email)
            <tr class="text-gray-700 dark:text-gray-400">
                <td class="px-4 py-3 text-md text-center">
                    {{ $ticket->customer->user->email }}
                </td>
            </tr>
        @endif
    </tbody>
</table>
