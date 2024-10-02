<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Modules\Files\CsvHandler;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getDataFromCsv('language.csv');

        foreach ($data as $row) {
            $gamePlatform = new Language();
            $gamePlatform->code = $row['code'];
            $gamePlatform->name = $row['name'];
            $gamePlatform->save();
        }
    }

    private function getDataFromCsv($csv){

        $csvHandler = new CsvHandler();
        return $csvHandler->getDataFromCsv($csv);
    }
}
