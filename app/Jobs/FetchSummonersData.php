<?php

namespace App\Jobs;

use App\Http\Services\RiotService;
use App\Models\Summoner;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;

class FetchSummonersData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $riotService = new RiotService();
        $summoners = Summoner::select(['id', 'summoner_name', 'summoner_id'])->with('leagueInfo')->get();

        $summoners->each(function (Summoner $summoner) use ($riotService) {
            if (!$summoner->summoner_id) {
                return true;
            }

            $response = $riotService->getLeagueInfo($summoner->summoner_id);

            if ($response) {

                if ($response->isEmpty()) {
                    return true;
                }

                $soloQueue = collect($response)->filter(function ($rank) {
                    return $rank->getQueueType() === 'RANKED_SOLO_5x5';
                })->first();

                if (!$soloQueue) {
                    return true;
                }

                if ($summoner->leagueInfo) {
                    $summoner->leagueInfo->update([
                        'tier' => $soloQueue->getTier(),
                        'rank' => $soloQueue->getRank(),
                        'league_points' => $soloQueue->getLeaguePoints(),
                        'wins' =>  $soloQueue->getWins(),
                        'losses' => $soloQueue->getLosses()
                    ]);
                } else {
                    $summoner->leagueInfo()->create([
                        'tier' => $soloQueue->getTier(),
                        'rank' => $soloQueue->getRank(),
                        'league_points' => $soloQueue->getLeaguePoints(),
                        'wins' =>  $soloQueue->getWins(),
                        'losses' => $soloQueue->getLosses()
                    ]);
                }
            }
        });
    }
}
