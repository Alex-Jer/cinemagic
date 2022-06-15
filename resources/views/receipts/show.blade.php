<x-dashboard.layout title="CineMagic - Recibo" :header="'Recibo #' . $receipt->id">
    <x-receipts.table :receipt="$receipt" />

</x-dashboard.layout>
