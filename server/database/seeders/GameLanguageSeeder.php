<?php

namespace Database\Seeders;

use App\Models\GameLanguage;
use App\Modules\Files\CsvHandler;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getDataFromCsv('game_language.csv');

        foreach ($data as $row) {
            $gamePlatform = new GameLanguage();
            $gamePlatform->game_id = $row['game_id'];
            $gamePlatform->language = $row['language'];
            $gamePlatform->short_description = $row['short_description'];
            $gamePlatform->long_description = $row['long_description'];
            $gamePlatform->save();
        }
    }

    private function getDataFromCsv($csv){

        $csvHandler = new CsvHandler();
        return $csvHandler->getDataFromCsv($csv);
    }
}
