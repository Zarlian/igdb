<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call(
            [
                DeveloperSeeder::class,
                GameSeeder::class,
                ScreenshotSeeder::class,
                GenreSeeder::class,
                GameGenreSeeder::class,
                PlatformSeeder::class,
                GamePlatformSeeder::class,
                TrailerSeeder::class,
                LanguageSeeder::class,
                GameLanguageSeeder::class,
                UserSeeder::class,
            ]
        );

    }
}
