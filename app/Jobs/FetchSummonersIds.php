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

class FetchSummonersIds implements ShouldQueue
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
        $summoners = Summoner::select(['id', 'summoner_name'])->get();

        $summoners->each(function (Summoner $summoner) use ($riotService) {
            $response = $riotService->getSummonerInfo($summoner->summoner_name);

            if ($response) {
                $summoner->update([
                    'summoner_id' => $response->getId(),
                    'level' => $response->getSummonerLevel(),
                    'profile_icon_id' => $response->getProfileIconId()
                ]);
            }
        });
    }
}
