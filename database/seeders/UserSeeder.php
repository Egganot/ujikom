<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Super',
                'email' => 'Zupper@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'superAdmin',
            ],
            [
                'name' => 'Apoteker',
                'email' => 'apoteker@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ],
        ];
        for ($i = 1; $i <= 5; $i++) {
            $userData[] = [
                'name' => 'Apoteker ' . $i,
                'email' => 'apoteker'.$i.'@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ];
        }
        for ($i = 1; $i <= 10; $i++) {
            $userData[] = [
                'name' => 'user ' . $i,
                'email' => 'user'.$i.'@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'user',
            ];
        }
        DB::table('users')->insert($userData);
    }
}
