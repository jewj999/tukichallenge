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

    private RiotService $riotService;
    public Collection $summonersInfo;

    public function __construct()
    {
        $this->riotService = new RiotService();
    }
    public function render()
    {
        $summoners = Summoner::all();

        $summonerParsed = $summoners->map(function ($summoner, $index) {
            $summonerInfo = $this->riotService->getSummonerInfo($summoner->summoner_name);
            if ($summonerInfo instanceof SummonerDTO) {
                $summonerLeague = $this->riotService->getLeagueInfo($summonerInfo->getId());
            } else {
                $summonerLeague = new Collection();
            }

            $soloQueue = null;

            if (!$summonerLeague->isEmpty()) {

                $soloQueue = $summonerLeague->filter(function ($rank) {
                    return $rank->getQueueType() === 'RANKED_SOLO_5x5';
                })->first();
            }
            return $summoner->toArray() +
                [
                    'level' => $summonerInfo->getSummonerLevel(),
                    'tier' => $soloQueue?->getTier(),
                    'rank' => $soloQueue?->getRank(),
                    'points' =>  $soloQueue?->getLeaguePoints()
                ];
        });

        $sorted = $summonerParsed
            ->sortByDesc(function ($value, $key) {
                return Tier::fromKey($value['tier'] ?? 'IRON');
            })
            // ->sortByDesc(function ($value, $key) {
            //     return Rank::fromKey($value['rank'] ?? 'IIII');
            // })
            // ->sortByDesc(function ($value, $key) {
            //     return $value['points'];
            // })

            // ->groupBy('tier')
        ;
        return view('livewire.summoners-table-component', ['summoners' => $sorted]);
    }
}
