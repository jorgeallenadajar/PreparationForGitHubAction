<?php

namespace Database\Seeders;

use App\Models\User_test;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0 ; 200 > $i; $i++){
            User_test::create([
                'name' => Str::random(10) ." ". Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'phone' => '0921313',
                'status' => 1,
                'date_created' => Carbon::now(),
               ]);
        }
    
    }
}
