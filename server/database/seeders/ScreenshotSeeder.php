<?php

namespace Database\Seeders;

use App\Models\Screenshot;
use App\Modules\Files\CsvHandler;
use Illuminate\Database\Seeder;

class ScreenshotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getDataFromCsv('screenshots.csv');

        foreach ($data as $row) {
            $screenshot = new Screenshot();
            $screenshot->game_id = $row['game_id'];
            $screenshot->url = $row['url'];
            $screenshot->save();
        }
    }

    private function getDataFromCsv($csv){

        $csvHandler = new CsvHandler();
        return $csvHandler->getDataFromCsv($csv);
    }
}
