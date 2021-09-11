<?php

namespace App\Http\Livewire;

use App\Enums\Rank;
use App\Enums\Tier;
use App\Http\Services\RiotService;
use App\Models\Summoner;
use Illuminate\Support\Collection;
use Livewire\Component;
use Riot\DTO\SummonerDTO;

class SummonersTableComponent extends Component
{

    public Collection $summonersInfo;

    public function __construct()
    {
        $this->riotService = new RiotService();
    }
    public function render()
    {
        $summoners = Summoner::with('leagueInfo')->get()->sortByDesc(function (Summoner $summoner) {
            return Tier::fromKey($summoner->leagueInfo?->tier ?? 'IRON');
        });
        return view('livewire.summoners-table-component', ['summoners' => $summoners]);
    }
}
