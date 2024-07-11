<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use App\Models\RequestDetails;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class RequestDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i=0; $i <=5; $i++) { 
            for ($j=1; $j <=$i; $j++) { 
                RequestDetails::create([
                'request_vehicle_id' => $i,
                'request_date' => $faker->date(),
                'name' => $faker->name(),
                'noted' => null,
                'nopol' => $faker->numerify(),
                'driver' => $faker->name(),
                'status' => $faker->randomElement(['approved', 'pending', 'cancel'])
                ]);
            }
        }

    }
}
