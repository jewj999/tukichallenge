<?php

namespace App\Http\Services;

use App\Models\Summoner;
use Cache;
use Exception;
use Illuminate\Support\Collection;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\DB;
use Str;

class TwitchService
{
    private Client $client;
    private Client $authClient;
    private Collection $config;

    private function configClient()
    {
        $this->client = new Client([
            'base_uri' => $this->config->get('api_url'),
        ]);

        $this->authClient = new Client([
            'base_uri' => $this->config->get('auth_url'),
        ]);
    }

    private function login()
    {
        $tokenResponse = $this->authClient->post('oauth2/token', [
            'query' => [
                'client_id' => $this->config->get('client_id'),
                'client_secret' => $this->config->get('client_secret'),
                'grant_type' => 'client_credentials'
            ]
        ])->getBody()->getContents();

        $tokenDecoded = json_decode($tokenResponse);

        Cache::put('twitch_token', $tokenDecoded->access_token, $tokenDecoded->expires_in);
    }

    public function __construct()
    {
        $this->config = collect(config('twitch'));
        $this->configClient();
    }

    public function fetchUserIds()
    {
        $summoners = Summoner::select(['id', 'twitch_channel'])
            ->where(DB::raw('LOWER(twitch_channel)'), 'LIKE', '%twitch%')
            ->get();

        $summoners->each(function (Summoner $summoner) {
            $response = $this->makeRequest('GET', 'helix/users', [
                'query' => [
                    'login' => Str::of($summoner->twitch_channel)->explode('/')->last()
                ]
            ]);

            if ($response) {
                $summoner->update([
                    'twitch_id' => $response->data[0]->id,
                    'twitch_profile_img' => $response->data[0]->profile_image_url,
                ]);
            }
        });
    }

    public function fetchStreamStatus()
    {
        $summoners = Summoner::select(['id', 'twitch_id'])
            ->whereNotNull('twitch_id')
            ->where(DB::raw('LOWER(twitch_channel)'), 'LIKE', '%twitch%')
            ->get();

        $summoners->each(function (Summoner $summoner) {
            $response = $this->makeRequest('GET', 'helix/streams', [
                'query' => [
                    'user_id' => $summoner->twitch_id
                ]
            ]);

            if ($response) {
                $summoner->update([
                    'twitch_stream_status' => $response->data ? true : false,
                ]);
            }
        });
    }

    private function makeRequest(string $method, string $url, array $params)
    {
        if (!Cache::has('twitch_token')) {
            $this->login();
            return $this->makeRequest($method, $url, $params);
        }

        $headers = [
            'headers' => [
                'Authorization' => 'Bearer ' . Cache::get('twitch_token'),
                'Client-Id' => $this->config->get('client_id')
            ]
        ];


        try {
            return json_decode($this->client->request($method, $url,  $headers + $params)->getBody()->getContents());
        } catch (ClientException $exception) {
            if ($exception->getResponse()->getStatusCode() == 401) {
                $this->login();
                return $this->makeRequest($method, $url, $params);
            }
        } catch (Exception $e) {
            return false;
        }
    }
}
