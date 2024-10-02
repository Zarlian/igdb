<?php

namespace Database\Seeders;

use App\Models\Trailer;
use App\Modules\Files\CsvHandler;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrailerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getDataFromCsv('trailers.csv');

        foreach ($data as $row) {
            $screenshot = new Trailer();
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
