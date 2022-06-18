<x-dashboard.layout title="CineMagic - Filme">
    <div class="min-w-0 col-span-2 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <h2 class="mb-4 text-3xl font-semibold text-gray-700 uppercase dark:text-gray-200">
            {{ $film->titulo }}
        </h2>
        <div class="grid grid-flow-col grid-rows-6 gap-4">
            <div class="h-auto row-span-6 w-72">
                @if ($film->cartaz_url)
                    <img class="w-full h-full rounded-lg" src="{{ asset('storage/cartazes/' . $film->cartaz_url) }}"
                        alt="">
                @else
                    <img class="w-full h-full rounded-lg" src="https://i.imgur.com/eDZNyW3.jpg?width=460&height=676" alt="">
                @endif
            </div>
            <div class="col-span-2 text-2xl font-semibold uppercase6 dark:text-gray-200">Sinopse</div>
            <div class="col-span-2 row-span-2 -mt-4 dark:text-gray-400">
                {{ $film->sumario }}
                <span class="invisible">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio qui pariatur sit eos quas provident ipsam
                    repudiandae ea illum? Repudiandae deleniti distinctio deserunt possimus? Possimus porro odit non odio
                    sit.
                </span>
            </div>
        </div>
    </div>

    <div class="min-w-0 col-span-2 p-4 mt-5 bg-white rounded-lg shadow-md dark:bg-gray-800">

        <div class="mb-2 ml-3 text-2xl font-semibold uppercase dark:text-gray-200">Sessões</div>
        @if ($film->screenings->count() > 0)
            <x-dashboard.screenings-table :film="$film" />
        @else
            <div class="text-center text-gray-600 dark:text-gray-400">
                <p>Este filme não tem sessões agendadas</p>
            </div>
        @endif
    </div>

    <div class="col-span-2 p-4 mt-5 rounded-lg">
        <div class="col-span-2 mb-5 text-2xl font-semibold uppercase6 dark:text-gray-200">Trailer</div>
        <div class="flex flex-row items-center justify-center">
            <div class="w-full" style="height:819px">
                <embed id="trailer" wmode="transparent" type="video/mp4" width="100%" height="100%" allowfullscreen>
            </div>
        </div>
    </div>
</x-dashboard.layout>

<script>
    function urlToEmbed() {
        var url = {!! json_encode($film->trailer_url) !!};
        var res = url.split("=");
        var embed = "https://www.youtube.com/embed/" + res[1];
        return embed;
    }

    window.addEventListener('load', function() {
        document.getElementById("trailer").src = urlToEmbed();
    })
</script>
