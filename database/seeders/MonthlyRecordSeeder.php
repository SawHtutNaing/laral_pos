<?php

namespace Database\Seeders;

use App\Models\MonthlyRecord;
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

        $startDate = Carbon::create($startYear, 1, 1);
        $endDate = Carbon::create($endYear, 12, 31);

        $currentDate = $startDate->copy();
        $vouncherRecord = new VouncherRecords();
        while ($currentDate->lte($endDate)) {

            $month = $currentDate->month;
            $year = $currentDate->year;

            MonthlyRecord::create([

                'month' => $month,
                'year' => $year,
                'total_sell' => $vouncherRecord->getSellByDate(),
                'total_quantity' => $vouncherRecord->getQuantityByDate()
            ]);



            $currentDate->addMonth();
        }
    }
}
