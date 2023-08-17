<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $arr = [
            [
                'name' => 'saw',
                'email' => 'saw@gmail.com',
                'password' => Hash::make(1111),
                'phone' => '09xxxxxxxxx',
                'gender' => 'male',
                'dob' => '11-11-11',
                'address' => 'yangon',
                'email_verified_at' => now(),
                'photo' => 'https://cdn-icons-png.flaticon.com/512/2206/2206368.png',
                'role' => 'admin',
                'remember_token' => Str::random(10),


            ],
            // [
            //     'name' => 'htut',
            //     'email' => 'htut@gmail.com',
            //     'password' => Hash::make(1111),

            //     'email_verified_at' => now(),
            //     'remember_token' => Str::random(10),



            // ]
        ];

        User::insert($arr);
        User::factory(10)->create();
    }
}
