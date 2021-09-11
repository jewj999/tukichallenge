<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\LeagueInfo
 *
 * @property int $id
 * @property int $summoner_id
 * @property string $tier
 * @property string $rank
 * @property int $league_points
 * @property int $wins
 * @property int $losses
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|LeagueInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LeagueInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LeagueInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|LeagueInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeagueInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeagueInfo whereLeaguePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeagueInfo whereLosses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeagueInfo whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeagueInfo whereSummonerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeagueInfo whereTier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeagueInfo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeagueInfo whereWins($value)
 */
	class LeagueInfo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Summoner
 *
 * @property int $id
 * @property string $name
 * @property string $summoner_name
 * @property string $twitch_channel
 * @property string|null $main_role
 * @property string|null $summoner_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\LeagueInfo|null $leagueInfo
 * @method static \Illuminate\Database\Eloquent\Builder|Summoner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Summoner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Summoner query()
 * @method static \Illuminate\Database\Eloquent\Builder|Summoner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Summoner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Summoner whereMainRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Summoner whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Summoner whereSummonerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Summoner whereSummonerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Summoner whereTwitchChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Summoner whereUpdatedAt($value)
 */
	class Summoner extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property-read string $profile_photo_url
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

