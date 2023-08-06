<?php

namespace Database\Seeders;

use App\Models\Vouncher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VouncherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vouncher::factory(5)->create();
    }
}
