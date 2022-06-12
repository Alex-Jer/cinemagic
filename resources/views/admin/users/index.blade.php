<x-dashboard.layout title="CineMagic - Utilizadores" header="Gestão de Utilizadores">
    <a class="text-red-600" href="{{ route('admin.users.store') }}">Test</a>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <x-dashboard.users-table :users="$users" :authUser="$authUser" />
        </div>
        {{ $users->onEachSide(2)->links() }}
    </div>
</x-dashboard.layout>
