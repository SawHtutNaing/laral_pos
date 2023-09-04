<?php

namespace Database\Seeders;

use App\Models\Vouncher;
use App\Models\YearlyRecord;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class YearlyRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startYear = 2023;
        $endYear = 2024;

        $startDate = Carbon::create(2023, 1, 1);
        $endDate = Carbon::now();

        $currentDate = $startDate->copy();
        $vouncher = new Vouncher();
        while ($currentDate->lte($endDate)) {


            $year = $currentDate->year;

            YearlyRecord::create([


                'year' => $year,
                'total_sell' => $vouncher->getSellByYear($year)
                // 'total_quantity' => $vouncher->getQuantityByDate()
            ]);



            $currentDate->addYear();
        }
    }
}
