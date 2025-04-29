<?php

namespace Database\Seeders;

use App\Models\Apoteker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ApotekerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Locale Indonesia
        $usedNumbers = [];

        foreach (range(1, 6) as $index) {
            do {
                $randomNumber = rand(2, 7);
            } while (in_array($randomNumber, $usedNumbers));

            $usedNumbers[] = $randomNumber;

            Apoteker::create([
                'NmApoteker' => $faker->name,
                'Alamat' => $faker->address,
                'Kota' => $faker->city,
                'Telpon' => $faker->phoneNumber,
                'id_user' => $randomNumber,
            ]);
        }
    }
}
