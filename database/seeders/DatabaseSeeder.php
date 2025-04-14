<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([CatalogSeeder::class]);
        $this->call([FirstModuleSeeder::class]);
        $this->call([SecondModuleSeeder::class]);
        $this->call([ThirdModuleSeeder::class]);
        $this->call([UsersSeeder::class]);
    }
}
