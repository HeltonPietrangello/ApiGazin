<?php

namespace Database\Seeders;

use App\Models\Developer;
use App\Models\Level;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Level::factory(20)->create();
        Developer::factory(20)->create();
    }
}
