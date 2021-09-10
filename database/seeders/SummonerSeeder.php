<?php

namespace Database\Seeders;

use File;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SummonerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('summoners')->insert($this->getArrayFromFile());
    }

    public function getArrayFromFile()
    {
        $data = File::get(database_path() . "/data/players.json");

        if ($data) {
            return json_decode($data, true)['players'];
        }

        return [];
    }
}
