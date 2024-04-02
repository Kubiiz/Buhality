<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Settings;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'game@etr.lv',
            'password' => bcrypt('password'),
            'group' => 1,
        ]);

        /**
         * Create settings seeder
         *
         * Later can be edited in admin panel
         */
        Settings::create([
            'app_name' => 'TestApp', // Page title in browser
            'description' => 'Party drinking game', // Page description in meta tags
            'keywords' => 'game, drink, fun', // Page keywords in meta tags
            'bomba' => 1, // Allow users to choose a Bomba when all players are drinking
            'age' => 18, // Minimal drinking age
        ]);
    }
}
