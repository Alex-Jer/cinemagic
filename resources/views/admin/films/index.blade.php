<x-dashboard.layout title="CineMagic - Gestão de Filmes" header="Gestão de Filmes">
    <div class="w-full overflow-hidden rounded-lg shadow-md">
        <div class="w-full overflow-x-auto">
            <x-dashboard.films-table :films="$films" />
        </div>
        {{ $films->onEachSide(2)->links() }}
    </div>
</x-dashboard.layout>
