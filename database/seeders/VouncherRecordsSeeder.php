<?php

namespace Database\Seeders;

use App\Models\Vouncher;
use App\Models\VouncherRecords;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VouncherRecordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VouncherRecords::factory(10)->create();

        foreach (VouncherRecords::all() as $key => $VouncherRecord) {
            $vouncher =  $VouncherRecord->Vouncher;
            $vouncher->total +=  $VouncherRecord->cost;
            $vouncher->net_total = $vouncher->total  + ($vouncher->total * ($vouncher->tax / 100));
            $vouncher->update();
        }
    }
}
