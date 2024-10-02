<?php

namespace Database\Seeders;

use App\Models\GameGenre;
use App\Modules\Files\CsvHandler;
use Illuminate\Database\Seeder;

class GameGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getDataFromCsv('games_genres.csv');

        foreach ($data as $row) {
            $gameGenre = new GameGenre();
            $gameGenre->game_id = $row['game_id'];
            $gameGenre->genre_id = $row['genre_id'];
            $gameGenre->save();
        }
    }

    private function getDataFromCsv($csv){

        $csvHandler = new CsvHandler();
        return $csvHandler->getDataFromCsv($csv);
    }
}
