<?php

namespace Database\Seeders;

use App\Models\Platform;
use App\Modules\Files\CsvHandler;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getDataFromCsv('platforms.csv');

        foreach ($data as $row) {
            $platform = new Platform();
            $platform->name = $row['name'];
            $platform->save();
        }
    }

    private function getDataFromCsv($csv){

        $csvHandler = new CsvHandler();
        return $csvHandler->getDataFromCsv($csv);
    }
}
