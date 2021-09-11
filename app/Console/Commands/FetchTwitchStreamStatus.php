<?php

namespace App\Console\Commands;

use App\Http\Services\TwitchService;
use Illuminate\Console\Command;

class FetchTwitchStreamStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitch:fetch-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetching twitch stream statuses';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $twitchService = new TwitchService();

        $twitchService->fetchStreamStatus();
        return 0;
    }
}
