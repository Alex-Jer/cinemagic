<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script>
        var films = @json($films);
        var dataset = @json($dataset);
    </script>
    <script src="{{ asset('js/charts/bars.js') }}" defer></script>
</head>
<x-dashboard.layout title="CineMagic - Estatísticas" header="Estatísticas">
    <form method="GET" action="{{ route('admin.statistics.index') }}" class="mb-3">
        <span class="float-left mr-2 -mt-1">
            <x-dashboard.date-input label="Data de início" name="startDate"
                value="{{ old('startDate', $startDate->format('Y-m-d')) === '' ? '' : old('startDate', $startDate->format('Y-m-d')) }}" />
        </span>
        <span class="float-left mr-2 -mt-1">
            <x-dashboard.date-input label="Data de fim" name="endDate"
                value="{{ $endDate ? $endDate->format('Y-m-d') : now()->format('Y-m-d') }}" />
        </span>
        <x-dashboard.button class="float-left mt-5 mr-2 button-primary">
            <svg class="w-4 h-4 -ml-2 mr-0.5 mt-px" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                    clip-rule="evenodd"></path>
            </svg>
            <x-slot:label>Filtrar</x-slot:label>
        </x-dashboard.button>
    </form>
    <div class="grid gap-6 mb-8 md:grid-cols-2">
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                Filmes com mais vendas
            </h4>
            <canvas id="bars"></canvas>
        </div>
    </div>
</x-dashboard.layout>
