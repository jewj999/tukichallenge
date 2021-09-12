<div
    class="flex flex-col items-center justify-center w-10/12 mx-auto bg-blue-gray-900 rounded-md p-5 border-collapse shadow-2xl ring-offset-purple-600 bg-blend-darken">
    <div class="py-4">
        <input type="text" wire:model.debounce.500ms="search"
            class="bg-blue-gray-600 py-2 px-6 focus:outline-none focus:ring focus:border-red-500 text-yellow-400"
            placeholder="Buscar...">
    </div>
    <table class=" w-full mx-auto rounded-sm text-gray-300 pt-2">
        <thead>
            <x-table-row>
                <x-table-cell th="true" class=""></x-table-cell>
                <x-table-cell th="true" class="w-48">Streamer</x-table-cell>
                <x-table-cell th="true">Cuenta</x-table-cell>
                <x-table-cell th="true">Nivel</x-table-cell>
                <x-table-cell th="true">Twitch</x-table-cell>
                <x-table-cell th="true">En partida</x-table-cell>
                <x-table-cell th="true">Elo</x-table-cell>
                <x-table-cell th="true">Victorias</x-table-cell>
                <x-table-cell th="true">Derrotas</x-table-cell>
                <x-table-cell th="true">Winrate</x-table-cell>
                <x-table-cell th="true">OPGG</x-table-cell>
            </x-table-row>
        </thead>
        <tbody>
            @php
            $counter = 1;
            @endphp
            @foreach ($summoners as $summoner )
            <x-table-row>
                <x-table-cell>
                    <div class="mr-5">
                        {{$counter}}
                    </div>
                </x-table-cell>
                <x-table-cell>
                    <div class="flex items-center">
                        <div class="mr-3">
                            @if ($summoner->twitch_profile_img)
                            <img class="w-10 h-10 rounded-full mx-auto" src="{{$summoner->twitch_profile_img}}">
                            @else
                            <div class="w-10 h-10 rounded-full mx-auto bg-blue-gray-700"></div>
                            @endif

                        </div>
                        {{$summoner->name}}
                    </div>
                </x-table-cell>
                <x-table-cell>{{$summoner->summoner_name}}</x-table-cell>
                <x-table-cell>{{$summoner->level}}</x-table-cell>
                <x-table-cell
                    class="{{Str::of($summoner->twitch_channel)->contains('twitch') ? 'text-purple-800'  : 'text-blue-800'}} text-center">
                    <div class="flex justify-center items-center ">
                        @if ($summoner->twitch_stream_status)
                        <span class="w-2 h-2 rounded-full bg-green-400 mr-2">
                        </span>
                        @else
                        <span class="w-2 h-2 rounded-full bg-blue-gray-700 mr-2">
                        </span>
                        @endif

                        @if (Str::of($summoner->twitch_channel)->contains('twitch'))
                        <a href="https://{{$summoner->twitch_channel}}" target="blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path class="fill-current"
                                    d="M2.149 0l-1.612 4.119v16.836h5.731v3.045h3.224l3.045-3.045h4.657l6.269-6.269v-14.686h-21.314zm19.164 13.612l-3.582 3.582h-5.731l-3.045 3.045v-3.045h-4.836v-15.045h17.194v11.463zm-3.582-7.343v6.262h-2.149v-6.262h2.149zm-5.731 0v6.262h-2.149v-6.262h2.149z"
                                    fill-rule="evenodd" clip-rule="evenodd" /></svg>
                        </a>
                        @else
                        <a href="https://{{$summoner->twitch_channel}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path class="fill-current"
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3 8h-1.35c-.538 0-.65.221-.65.778v1.222h2l-.209 2h-1.791v7h-3v-7h-2v-2h2v-2.308c0-1.769.931-2.692 3.029-2.692h1.971v3z" />
                            </svg>
                        </a>
                        @endif


                    </div>
                </x-table-cell>
                <x-table-cell>
                    <div class="flex justify-center items-center">
                        @if ($summoner->in_match)
                        <span class="bg-green-500 h-5 w-5 rounded-full">

                        </span>
                        @else
                        <span class="bg-blue-gray-700 h-5 w-5 rounded-full">

                        </span>
                        @endif
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
                <x-table-cell>
                    <div class="flex items-center justify-center">
                        <a href="https://lan.op.gg/summoner/userName={{$summoner->summoner_name}}" target="blank">
                            <img src="https://opgg-static.akamaized.net/images/gnb/svg/00-opgglogo.svg" alt=""
                                class="w-12 fill-current bg-blue-600 p-1 rounded-lg">
                        </a>
                    </div>
                </x-table-cell>
            </x-table-row>
            @php
            $counter++;
            @endphp
            @endforeach
        </tbody>
    </table>
</div>
