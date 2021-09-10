<?php

namespace App\Http\Services;

use App\Models\Summoner;
use Exception;
use Illuminate\Support\Collection;
use Riot\API;
use Riot\Connection;
use Riot\Enum\RegionEnum;
use Symfony\Component\HttpClient\Psr18Client;

class RiotService
{
    private Connection $connection;
    private API $riotApi;
    private $httpClient;
    public function __construct()
    {
        $this->summonersInfo = new Collection();
        $this->httpClient = new Psr18Client();
        $this->connection = new Connection($this->httpClient, config('riot.api_key'), $this->httpClient, $this->httpClient);
        $this->riotApi = new API($this->connection);
    }

    public function getSummonerInfo(string $summonerName)
    {
        try {
            return $this->riotApi->getVersion4()->getSummoner()->getByName($summonerName, RegionEnum::LA1());
        } catch (Exception $e) {
            return 0;
        }
    }

    public function getLeagueInfo(string $summonerId)
    {
        try {
            return $this->riotApi->getVersion4()->getLeague()->getBySummonerId($summonerId, RegionEnum::LA1());
        } catch (Exception $e) {
            return 0;
        }
    }
}
