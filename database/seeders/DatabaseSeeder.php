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
            'group' => 1, // 1-admin
        ]);

        /**
         * Create settings seeder
         * Later can be edited in admin panel
         */
        Settings::create([
            'app_name' => 'TestApp', // Page title in browser
            'description' => 'Party drinking game', // Page description in meta tags
            'keywords' => 'game, drink, fun', // Page keywords in meta tags
            'age' => 18, // Legal minimal drinking age
            'random' => json_encode([
                'inc_one' => 44,
                'inc_two' => 15,
                'inc_all' => 10,
                'noone' => 10,
                'dec_one' =>20,
                'bomb' => 1,
            ]), // Default percentages of random numbers how the game will work
        ]);
    }
}
