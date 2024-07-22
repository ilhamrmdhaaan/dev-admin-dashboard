<?php

namespace Database\Seeders;

use App\Models\Profiles;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        for ($i = 0; $i <= 3; $i++) {
            for ($j=1; $j <$i; $j++) { 
                Profiles::create([
                    'user_id' => $i,
                    'email' => $faker->email(),
                    'name' => $faker->name(),
                    'phone' => $faker->phoneNumber()
                ]);
            }
        }
    }
}
