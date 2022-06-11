<x-dashboard.layout title="CineMagic - Recibos" header="Os seus recibos">
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <x-dashboard.receipts-table :receipts="$receipts" />
        </div>
        {{ $receipts->onEachSide(2)->links() }}
    </div>
</x-dashboard.layout>
