<div
    class="overflow-x-auto flex flex-col items-center justify-center w-10/12 mx-auto bg-blue-gray-900 rounded-md p-5 border-collapse shadow-2xl ring-offset-purple-600 bg-blend-darken">
    <div class="py-4 overflow-x-auto">
        <input type="text" wire:model.debounce.500ms="search"
            class="bg-blue-gray-600 py-2 px-6 focus:outline-none focus:ring focus:border-red-500 text-yellow-400"
            placeholder="Buscar...">
    </div>
    <table class="table-fixed w-full mx-auto rounded-sm text-gray-300 pt-2 text-md">
        <thead>
            <x-table-row class="text-left">
                <x-table-cell th="true" class="w-14"></x-table-cell>
                <x-table-cell th="true" class="w-32">Streamer</x-table-cell>
                <x-table-cell th="true" class="w-20 text-center">Stream</x-table-cell>
                <x-table-cell th="true" class="w-20 text-center">Partida</x-table-cell>
                <x-table-cell th="true" class="w-48"><span class="ml-6">Cuenta</span></x-table-cell>
                {{-- <x-table-cell th="true" class="w-12 text-center">Nivel</x-table-cell> --}}
                <x-table-cell th="true" class="w-24 text-center">Elo</x-table-cell>

                <x-table-cell th="true" class="w-16 text-center">Partidas</x-table-cell>
                <x-table-cell th="true" class="w-16 text-center">Victorias</x-table-cell>
                <x-table-cell th="true" class="w-16 text-center">Derrotas</x-table-cell>
                <x-table-cell th="true" class="w-16 text-center">Winrate</x-table-cell>
                <x-table-cell th="true" class="w-16 text-center">OPGG</x-table-cell>
            </x-table-row>
        </thead>
        <tbody>
            @php
            $counter = 1;
            @endphp
            @foreach ($summoners as $summoner )
            <x-table-row class="h-20 {{$counter % 2 != 0 ? 'bg-blue-gray-800' : ''}}">
                <x-table-cell class="text-center">
                    <span class="">
                        {{$counter}}
                    </span>
                </x-table-cell>
                <x-table-cell>
                    <div class="flex items-center">
                        <div class="mr-3 flex flex-col">
                            @if ($summoner->twitch_profile_img)
                            <img class="w-12 h-12 rounded-full mx-auto" src="{{$summoner->twitch_profile_img}}">
                            @else
                            <div class="w-12 h-12 rounded-full mx-auto bg-blue-gray-700"></div>
                            @endif
                        </div>
                        <div class=" w-4/6 text-left">
                            <span> {{$summoner->name}}</span>
                        </div>
                    </div>
                </x-table-cell>
                <x-table-cell>
                    <div class="h-full w-full flex flex-col items-center justify-end">
                        <a href="https://{{$summoner->twitch_channel}}" target="blank">
                            <div class="flex flex-col justify-center items-center">
                                @if (Str::of($summoner->twitch_channel)->contains('twitch'))
                                <x-bi-twitch class="text-purple-800 w-7 h-7" />
                                @else
                                <x-bi-facebook class="text-blue-800 w-7 h-7" />
                                @endif
                                <div @class([ 'text-sm rounded-md mt-1' , 'bg-red-700'=>
                                    $summoner->twitch_stream_status,
                                    'bg-blue-gray-700' => !$summoner->twitch_stream_status
                                    ])
                                    ><span class="px-2">En vivo</span></div>
                            </div>
                        </a>
                    </div>
                </x-table-cell>
                <x-table-cell>
                    <div class="flex flex-col justify-end items-center h-full w-full">
                        @if ($summoner->in_match && $summoner->champion_id)
                        <div class="w-7 h-7">
                            <img src="{{$this->getChampionSquareImageUrl($summoner->champion_id)}}"
                                alt="Champion Image">
                        </div>
                        @endif
                        <div @class([ 'text-sm rounded-md mt-1' , 'bg-green-700'=> $summoner->in_match,
                            'bg-blue-gray-700' => !$summoner->in_match
                            ])
                            ><span class="px-2">En partida</span></div>
                        {{-- <span
                            class="h-5 w-5 rounded-full {{$summoner->in_match ? 'bg-green-500' : 'bg-blue-gray-700'}}">
                        </span> --}}
                    </div>
                </x-table-cell>
                <x-table-cell>
                    <div class="ml-6 flex items-center">
                        <div class="mr-3">
                            <img class="w-10 h-10 rounded-full"
                                src="{{$this->getProfileIconUrl($summoner->profile_icon_id ?? 685)}}" alt="">
                        </div>
                        <span>{{$summoner->summoner_name}}</span>
                    </div>
                </x-table-cell>

                {{-- <x-table-cell class="text-center"><span class="text-center">{{$summoner->level}}</span>
                </x-table-cell> --}}


                <x-table-cell>
                    <div class="flex items-center justify-center">
                        <x-ranked-emblem :tier="$summoner->leagueInfo?->tier" />
                        {{$summoner->leagueInfo?->rank}}
                        {{$summoner->leagueInfo?->league_points ?? 0}}pl
                    </div>
                </x-table-cell>

                <x-table-cell class="text-center">
                    <span class="text-green-600 text-center">
                        {{($summoner->leagueInfo?->wins ?? 0) + ($summoner->leagueInfo?->losses ?? 0)}}
                    </span>
                </x-table-cell>
                <x-table-cell class="text-center">
                    <span class="text-green-500 text-center">
                        {{$summoner->leagueInfo?->wins}}
                    </span>
                </x-table-cell>
                <x-table-cell class="text-center">
                    <span class="text-red-500 text-center">
                        {{$summoner->leagueInfo?->losses}}
                    </span>
                </x-table-cell>
                @php
                $total = $summoner->leagueInfo?->wins + $summoner->leagueInfo?->losses;
                $percentage = $total ? round( ((100 * $summoner->leagueInfo->wins) / $total), 2) : 0
                @endphp
                <x-table-cell class="text-center">
                    @if ($percentage > 0 && $percentage <=45) <span class="text-red-600">
                        {{ $percentage }}%
                        </span>

                        @elseif ($percentage > 45 && $percentage <= 65) <span class="text-yellow-700 ">
                            {{ $percentage }}%
                            </span>

                            @elseif ($percentage > 65 && $percentage <=75) <span class="text-yellow-500">
                                {{ $percentage }}%
                                </span>
                                @elseif ($percentage > 75)
                                <span class="text-green-600">
                                    {{ $percentage }}%
                                </span>
                                @endif
                </x-table-cell>
                <x-table-cell class="text-center">
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
