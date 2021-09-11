<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Summoner extends Model
{
    protected $fillable = [
        'name',
        'summoner_name',
        'twitch_channel',
        'main_role',
        'summoner_id',
        'level'
    ];

    use HasFactory;

    public function leagueInfo(): HasOne
    {
        return $this->hasOne(LeagueInfo::class);
    }
}
