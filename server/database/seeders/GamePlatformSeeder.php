<?php

namespace Database\Seeders;

use App\Models\GamePlatform;
use App\Modules\Files\CsvHandler;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GamePlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getDataFromCsv('game-platform.csv');

        foreach ($data as $row) {
            $gamePlatform = new GamePlatform();
            $gamePlatform->game_id = $row['game_id'];
            $gamePlatform->platform_id = $row['platform_id'];
            $gamePlatform->save();
        }
    }

    private function getDataFromCsv($csv){

        $csvHandler = new CsvHandler();
        return $csvHandler->getDataFromCsv($csv);
    }
}
