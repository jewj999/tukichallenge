<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeagueInfo extends Model
{
    protected $fillable = [
        'tier',
        'rank',
        'league_points',
        'wins',
        'losses'
    ];
    use HasFactory;
}
