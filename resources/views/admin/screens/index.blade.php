<x-dashboard.layout title="CineMagic - Salas" header="Salas">
    <div>
        <form method="GET" action="{{ route('admin.screens.create') }}" class="mb-3">
            <x-dashboard.button class="float-left -mt-1 mb-4 button-primary">
                <svg class="w-4 h-4 -ml-2 mr-0.5 mt-px" data-darkreader-inline-fill="" fill="currentColor"
                    style="--darkreader-inline-fill: currentColor;" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                        clip-rule="evenodd"></path>
                </svg>
                <x-slot:label>Nova Sala</x-slot:label>
            </x-dashboard.button>
        </form>
    </div>
    <div class="w-full overflow-hidden rounded-lg shadow-md">
        <div class="w-full overflow-x-auto">
            <x-dashboard.screens-table :screens="$screens" />
        </div>
        {{ $screens->onEachSide(2)->links() }}
    </div>
</x-dashboard.layout>
