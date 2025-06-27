<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hotel::insert([
            [
                'name' => 'Sol Grand Premium',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Brisa Grand Premium',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sauípe Resorts Ala Mar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sauípe Resorts Ala Terra',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hotel Pousada',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hotel Cristal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hotel Turismo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hotel Luupi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hotel Giardino',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
