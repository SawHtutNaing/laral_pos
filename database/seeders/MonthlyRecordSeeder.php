<?php

namespace Database\Seeders;

use App\Models\MonthlyRecord;
use App\Models\Vouncher;
use App\Models\VouncherRecords;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MonthlyRecordSeeder extends Seeder
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

            $month = $currentDate->month;
            $year = $currentDate->year;

            MonthlyRecord::create([

                'month' => $month,
                'year' => $year,
                'total_sell' => $vouncher->getSellByMonth($month, $year)
                // 'total_quantity' => $vouncher->getQuantityByDate()
            ]);



            $currentDate->addMonth();
        }
    }
}
