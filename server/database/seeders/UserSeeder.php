<?php


namespace Database\Seeders;

use App\Models\User;
use App\Modules\Files\CsvHandler;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getDataFromCsv('users.csv');

        foreach ($data as $row) {
            $user = new User();
            $user->name = $row['name'];
            $user->email = $row['email'];
            $user->password = $row['password'];
            $user->role = $row['role'];
            $user->save();
        }
    }

    private function getDataFromCsv($csv)
    {

        $csvHandler = new CsvHandler();
        return $csvHandler->getDataFromCsv($csv);
    }
}
