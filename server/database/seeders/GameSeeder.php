<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Modules\Files\CsvHandler;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $data = $this->getDataFromCsv('game.csv');

        foreach ($data as $row) {
            $game = new Game();
            $game->title = $row['title'];
            $game->release_date = $row['release_date'];
            $game->esrb_rating = $row['esrb_rating'];
            $game->average_rating = $row['average_rating'];
            $game->rating_count = $row['rating_count'];
            $game->developer_id = $row['developer_id'];
            $game->cover = $row['cover'];
            $game->save();
        }
    }

    private function getDataFromCsv($csv){

        $csvHandler = new CsvHandler();
        return $csvHandler->getDataFromCsv($csv);
    }


}
