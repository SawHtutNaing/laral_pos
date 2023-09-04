<?php

namespace Database\Seeders;

use App\Models\DayilyRecord;
use App\Models\User;
use App\Models\Vouncher;
use App\Models\VouncherRecords;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DayilyRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {;

        // $startYear = 2023;
        // $endYear = 2024;

        $startDate = Carbon::create(2023, 1, 1);
        $endDate = Carbon::now();

        $currentDate = $startDate->copy();
        $vouncher = new Vouncher();
        while ($currentDate->lte($endDate)) {
            $day = $currentDate->day;
            $month = $currentDate->month;
            $year = $currentDate->year;
            $thatDay = "$year-$month-$day";
            DayilyRecord::create([
                'day' => $day,
                'month' => $month,
                'year' => $year,
                'total_sell' => $vouncher->getSellByDate($thatDay),
                'cash' => $vouncher->getSellByDate($thatDay) / 1.05,

                // 'total_quantity' => $vouncher->getQuantityByDate($thatDay)
                // 'user_id' => User::all()->random()->id
            ]);



            $currentDate->addDay();
        }
    }
}
