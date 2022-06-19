<x-dashboard.layout title="CineMagic - Salas" header="Salas">
    <div class="w-full overflow-hidden rounded-lg shadow-md">
        <div class="w-full overflow-x-auto">
            <x-dashboard.screens-table :screens="$screens" />
        </div>
        {{ $screens->onEachSide(2)->links() }}
    </div>
</x-dashboard.layout>
