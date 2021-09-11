<div>
    <table class="table-auto">
        <thead>
            <tr>
                <th>Posición</th>
                <th>Nombre</th>
                <th>Nombre de invocador(Soloq Challenge)</th>
                <th>Nivel</th>
                <th>Canal de twitch</th>
                <th>Rol</th>
                <th>Elo</th>
                <th>Victorias</th>
                <th>Derrotas</th>
                <th>% De victorias</th>
            </tr>
        </thead>
        <tbody>
            @php
            $counter = 1;
            @endphp
            @foreach ($summoners as $summoner )
            <tr>
                <td>{{$counter}}</td>
                {{-- {{$summoner}} --}}
                <td>{{$summoner->name}}</td>
                <td>{{$summoner->summoner_name}}</td>
                <td>{{$summoner->level}}</td>
                <td>{{$summoner->twitch_channel}}</td>
                <td>{{$summoner->main_role}}</td>
                <td>{{$summoner->leagueInfo?->tier}} {{$summoner->leagueInfo?->rank}}
                    {{$summoner->leagueInfo?->league_points ?? 0}}pl</td>
                <td>{{$summoner->leagueInfo?->wins}}</td>
                <td>{{$summoner->leagueInfo?->losses}}</td>
                @php
                $total = $summoner->leagueInfo?->wins + $summoner->leagueInfo?->losses;
                @endphp
                <td>{{$total ? round( ((100 * $summoner->leagueInfo->wins) / $total), 2) : 0 }}
                </td>
            </tr>
            @php
            $counter++;
            @endphp
            @endforeach
        </tbody>
    </table>
</div>
