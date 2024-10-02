<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Modules\Files\CsvHandler;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getDataFromCsv('genres.csv');

        foreach ($data as $row) {
            $genre = new Genre();
            $genre->name = $row['name'];
            $genre->save();
        }
    }

    private function getDataFromCsv($csv){

        $csvHandler = new CsvHandler();
        return $csvHandler->getDataFromCsv($csv);
    }
}
