<?php

namespace App\Http\Livewire;

use App\Enums\Rank;
use App\Enums\Tier;
use App\Http\Services\RiotService;
use App\Models\Summoner;
use DB;
use File;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;
use Riot\DTO\SummonerDTO;

class SummonersTableComponent extends Component
{

    public Collection $summonersInfo;
    public string $search = '';
    public Collection $champions;
    public string $dataDragonUrl;

    public function __construct()
    {
        $this->riotService = new RiotService();
        $this->champions = collect(json_decode(File::get(database_path() . '/data/champion.json'), true));
        $this->dataDragonUrl = config('riot.data_dragon_url');
    }
    public function render()
    {
        $summoners = Summoner::where(DB::raw('LOWER(summoner_name)'), 'LIKE', '%' . Str::lower($this->search) . '%')
            ->orWhere(DB::raw('LOWER(name)'), 'LIKE', '%' . Str::lower($this->search) . '%')
            ->with('leagueInfo')->get();

        return view('livewire.summoners-table-component', ['summoners' => $this->orderByTier($summoners)]);
    }

    private function orderByTier(Collection $summoners)
    {
        return $summoners->groupBy([
            function (Summoner $summoner) {
                return $summoner->leagueInfo?->tier ?? 'IRON';
            },
            function (Summoner $summoner) {
                return $summoner->leagueInfo?->rank ?? 'IIII';
            }
        ])->map(function (Collection $tier) {
            return $tier->map(function (Collection $rank) {
                return $rank->sortByDesc(function (Summoner $summoner) {
                    return $summoner->leagueInfo?->league_points ?? 0;
                });
            })->collapse();
        })->map(function (Collection $rank, $index) {
            return $rank->sortByDesc(function (Summoner $summoner) {
                return Rank::fromKey($summoner->leagueInfo?->rank ?? 'IIII');
            });
        })->sortByDesc(function (Collection $c, $index) {
            return Tier::fromKey($index);
        })->collapse();
    }

    public function getChampionSquareImageUrl($championId)
    {
        return $this->dataDragonUrl . 'img/champion/' . collect($this->champions['data'])->where('key', $championId)->first()['image']['full'];
    }

    public function getProfileIconUrl($profileIconId = 1)
    {
        return $this->dataDragonUrl . 'img/profileicon/' . $profileIconId . '.png';
    }
}
