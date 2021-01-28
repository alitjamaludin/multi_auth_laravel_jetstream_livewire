<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ConfigDesa;

class ConfigDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConfigDesa::factory()->count(1)->create();
    }
}
