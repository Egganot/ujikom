<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;
use Faker\Factory as Faker;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        foreach (range(1, 10) as $index) {
            Supplier::create([
                'NmSupplier' => $faker->company,
                'Alamat' => $faker->address,
                'Kota' => $faker->city,
                'Telpon' => $faker->phoneNumber,
            ]);
        }
    }
}
