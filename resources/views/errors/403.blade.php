<x-error-page errorCode="403" errorTitle="Forbidden">
    {{ $exception->getMessage() ?: 'Acesso proibido' }}
</x-error-page>
