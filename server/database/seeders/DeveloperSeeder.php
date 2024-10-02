<?php

namespace Database\Seeders;

use App\Models\Developer;
use App\Modules\Files\CsvHandler;
use Illuminate\Database\Seeder;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getDataFromCsv('developers.csv');

        foreach ($data as $row) {
            $developer = new Developer();
            $developer->name = $row['name'];
            $developer->save();
        }
    }

    private function getDataFromCsv($csv){

        $csvHandler = new CsvHandler();
        return $csvHandler->getDataFromCsv($csv);
    }
}
