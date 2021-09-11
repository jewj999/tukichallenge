<div
    class="flex flex-col items-center justify-center w-10/12 mx-auto bg-blue-gray-900 rounded-md p-5 border-collapse shadow-2xl ring-offset-purple-600 bg-blend-darken">
    <div class="py-4">
        <input type="text" wire:model.debounce.500ms="search" class="bg-blue-gray-600 py-2 px-6 focus:outline-none focus:ring focus:border-red-500 text-yellow-400"
            placeholder="Buscar..." >
    </div>
    <table class=" w-full mx-auto rounded-sm text-gray-300 pt-2">
        <thead>
            <x-table-row>
                <x-table-cell th="true"></x-table-cell>
                <x-table-cell th="true" class="w-48">Streamer</x-table-cell>
                <x-table-cell th="true">Cuenta</x-table-cell>
                <x-table-cell th="true">Nivel</x-table-cell>
                <x-table-cell th="true">Twitch</x-table-cell>
                <x-table-cell th="true">Elo</x-table-cell>
                <x-table-cell th="true">Victorias</x-table-cell>
                <x-table-cell th="true">Derrotas</x-table-cell>
                <x-table-cell th="true">Winrate</x-table-cell>
            </x-table-row>
        </thead>
        <tbody>
            @php
            $counter = 1;
            @endphp
            @foreach ($summoners as $summoner )
            <x-table-row>
                <x-table-cell>{{$counter}}</x-table-cell>
                <x-table-cell>{{$summoner->name}}</x-table-cell>
                <x-table-cell>{{$summoner->summoner_name}}</x-table-cell>
                <x-table-cell>{{$summoner->level}}</x-table-cell>
                <x-table-cell class=" text-purple-800 text-center">
                    <div class="flex justify-center">
                        <a href="https://{{$summoner->twitch_channel}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path class="fill-current"
                                    d="M2.149 0l-1.612 4.119v16.836h5.731v3.045h3.224l3.045-3.045h4.657l6.269-6.269v-14.686h-21.314zm19.164 13.612l-3.582 3.582h-5.731l-3.045 3.045v-3.045h-4.836v-15.045h17.194v11.463zm-3.582-7.343v6.262h-2.149v-6.262h2.149zm-5.731 0v6.262h-2.149v-6.262h2.149z"
                                    fill-rule="evenodd" clip-rule="evenodd" /></svg>
                        </a>
                    </div>
                </x-table-cell>
                <x-table-cell>
                    <div class="flex justify-center items-center">
                        <x-ranked-emblem :tier="$summoner->leagueInfo?->tier ?? 'IRON'" />
                        {{$summoner->leagueInfo?->rank}}
                        {{$summoner->leagueInfo?->league_points ?? 0}}pl
                    </div>
                </x-table-cell>
                <x-table-cell>
                    <span class="text-green-500">
                        {{$summoner->leagueInfo?->wins}}
                    </span>
                </x-table-cell>
                <x-table-cell>
                    <span class="text-red-500">
                        {{$summoner->leagueInfo?->losses}}
                    </span>
                </x-table-cell>
                @php
                $total = $summoner->leagueInfo?->wins + $summoner->leagueInfo?->losses;
                $percentage = $total ? round( ((100 * $summoner->leagueInfo->wins) / $total), 2) : 0
                @endphp
                <x-table-cell>
                    <span class="">
                        {{ $percentage }} %
                    </span>
                </x-table-cell>
            </x-table-row>
            @php
            $counter++;
            @endphp
            @endforeach
        </tbody>
    </table>
</div>
