<x-error-page errorCode="404" errorTitle="Not Found">
    Página não encontrada. Verifica o endereço ou
    <a class="text-purple-600 hover:underline dark:text-purple-300" href="{{ url()->previous() }}">
        volta atrás</a>.
</x-error-page>
