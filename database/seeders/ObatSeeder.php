<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Obat;
use App\Models\Supplier;
use Faker\Factory as Faker;

class ObatSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // foreach (range(1, 30) as $index) {
        //     Obat::create([
        //         'NmObat' => $faker->word,
        //         'Jenis' => $faker->randomElement(['Tablet', 'Kapsul', 'Syrup', 'Salep']),
        //         'Satuan' => $faker->randomElement(['Strip', 'Botol', 'Box']),
        //         'HargaBeli' => $faker->numberBetween(5000, 50000),
        //         'HargaJual' => $faker->numberBetween(6000, 60000),
        //         'Stok' => $faker->numberBetween(10, 100),
        //         'KdSupplier' => $faker->numberBetween(1, 10),
        //     ]);
        // }

        $obatList = [
            ['NmObat' => 'Paramex', 'Jenis' => 'Tablet', 'Satuan' => 'Strip', 'HargaBeli' => 5000, 'HargaJual' => 7000],
            ['NmObat' => 'Bodrex', 'Jenis' => 'Tablet', 'Satuan' => 'Strip', 'HargaBeli' => 6000, 'HargaJual' => 8000],
            ['NmObat' => 'Promag', 'Jenis' => 'Tablet', 'Satuan' => 'Strip', 'HargaBeli' => 7000, 'HargaJual' => 9000],
            ['NmObat' => 'Mixagrip', 'Jenis' => 'Tablet', 'Satuan' => 'Strip', 'HargaBeli' => 5500, 'HargaJual' => 7500],
            ['NmObat' => 'Konidin', 'Jenis' => 'Syrup', 'Satuan' => 'Botol', 'HargaBeli' => 10000, 'HargaJual' => 13000],
            ['NmObat' => 'Neurobion', 'Jenis' => 'Tablet', 'Satuan' => 'Strip', 'HargaBeli' => 15000, 'HargaJual' => 18000],
            ['NmObat' => 'Woods Cough Syrup', 'Jenis' => 'Syrup', 'Satuan' => 'Botol', 'HargaBeli' => 12000, 'HargaJual' => 15000],
            ['NmObat' => 'OBH Combi', 'Jenis' => 'Syrup', 'Satuan' => 'Botol', 'HargaBeli' => 11000, 'HargaJual' => 14000],
            ['NmObat' => 'Bodrexin', 'Jenis' => 'Syrup', 'Satuan' => 'Botol', 'HargaBeli' => 9000, 'HargaJual' => 12000],
            ['NmObat' => 'Antangin', 'Jenis' => 'Tablet', 'Satuan' => 'Strip', 'HargaBeli' => 4000, 'HargaJual' => 6000],
            ['NmObat' => 'Insto', 'Jenis' => 'Cairan', 'Satuan' => 'Botol', 'HargaBeli' => 8000, 'HargaJual' => 10000],
            ['NmObat' => 'Betadine', 'Jenis' => 'Cairan', 'Satuan' => 'Botol', 'HargaBeli' => 9500, 'HargaJual' => 12000],
            ['NmObat' => 'Minyak Kayu Putih Cap Lang', 'Jenis' => 'Cairan', 'Satuan' => 'Botol', 'HargaBeli' => 7000, 'HargaJual' => 9500],
            ['NmObat' => 'FreshCare', 'Jenis' => 'Cairan', 'Satuan' => 'Botol', 'HargaBeli' => 8500, 'HargaJual' => 11000],
            ['NmObat' => 'Diapet', 'Jenis' => 'Tablet', 'Satuan' => 'Strip', 'HargaBeli' => 6000, 'HargaJual' => 8500],
            ['NmObat' => 'Bisolvon', 'Jenis' => 'Syrup', 'Satuan' => 'Botol', 'HargaBeli' => 14000, 'HargaJual' => 17000],
            ['NmObat' => 'Entrostop', 'Jenis' => 'Tablet', 'Satuan' => 'Strip', 'HargaBeli' => 5000, 'HargaJual' => 7000],
            ['NmObat' => 'Sangobion', 'Jenis' => 'Kapsul', 'Satuan' => 'Strip', 'HargaBeli' => 16000, 'HargaJual' => 19000],
            ['NmObat' => 'Combantrin', 'Jenis' => 'Tablet', 'Satuan' => 'Strip', 'HargaBeli' => 8000, 'HargaJual' => 10000],
            ['NmObat' => 'Hemaviton', 'Jenis' => 'Kapsul', 'Satuan' => 'Strip', 'HargaBeli' => 13000, 'HargaJual' => 16000],
        ];

        foreach ($obatList as $obat) {
            Obat::create([
                'NmObat' => $obat['NmObat'],
                'Jenis' => $obat['Jenis'],
                'Satuan' => $obat['Satuan'],
                'HargaBeli' => $obat['HargaBeli'],
                'HargaJual' => $obat['HargaJual'],
                'Stok' => rand(10, 100),
                'kadaluarsa' => $faker->dateTimeBetween('-1 year', '+1 year'),
                'KdSupplier' => rand(1, 10),
            ]);
        }
    }
}
