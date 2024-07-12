<?php

namespace Database\Seeders;

use App\Models\RequestVehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RequestVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');


        for ($i = 1; $i <= 5; $i++) {
            RequestVehicle::create([
                'email' => $faker->email(),
                'request_date' => $faker->date(),
                'maximum_person' => $faker->randomElement(['1', '2', '3']),
                'division' => $faker->randomElement(['Finance', 'IT', 'Legal', 'Marketing', 'Oprasional']),
                'direction' => null,
                'necessity' => null
            ]);
        }

    }
}
