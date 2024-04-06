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
    }
}
