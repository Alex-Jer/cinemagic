<x-dashboard.layout title="CineMagic - Utilizadores" header="Gestão de Utilizadores">
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <x-dashboard.users-table :users="$users" />
        </div>
        {{ $users->onEachSide(2)->links() }}
    </div>
</x-dashboard.layout>
