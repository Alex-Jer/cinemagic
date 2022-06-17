<x-dashboard.layout title="CineMagic - Bilhetes" header="Os seus bilhetes">
    <div class="w-full overflow-hidden rounded-lg shadow-md">
        <div class="w-full overflow-x-auto">
            <x-dashboard.tickets-table :tickets="$tickets" />
        </div>
        {{ $tickets->onEachSide(2)->links() }}
    </div>
</x-dashboard.layout>
