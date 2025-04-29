<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggan;
use Faker\Factory as Faker;

class PelangganSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID'); // Locale Indonesia
        // $usedNumbers = [];

        foreach (range(8, 17) as $index) {

            Pelanggan::create([
                'NmPelanggan' => $faker->name,
                'Alamat' => $faker->address,
                'Kota' => $faker->city,
                'Telpon' => $faker->phoneNumber,
                'id_user' => $index,
            ]);
        }
    }
}
