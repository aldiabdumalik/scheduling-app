<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::truncate();
        $colors = [
            [
                'name' => 'Navy',
                'code' => '#03045E'
            ],
            [
                'name' => 'Soft Orange',
                'code' => '#FFAB76'
            ],
            [
                'name' => 'Soft Yellow',
                'code' => '#FFFDA2'
            ],
            [
                'name' => 'Biru Langit',
                'code' => '#85F4FF'
            ],
            [
                'name' => 'Hijau',
                'code' => '#00C897'
            ],
            [
                'name' => 'Pink',
                'code' => '#FF8AAE'
            ],
            [
                'name' => 'Merah Bata',
                'code' => '#DA1212'
            ],
            [
                'name' => 'Ungu',
                'code' => '#6E3CBC'
            ],
            [
                'name' => 'Gray',
                'code' => '#EEEEEE'
            ],
            [
                'name' => '#FAFF00',
                'code' => '#FAFF00'
            ],
            [
                'name' => '#B3541E',
                'code' => '#B3541E'
            ],
            [
                'name' => '#502064',
                'code' => '#502064'
            ],
            [
                'name' => '#C6D57E',
                'code' => '#C6D57E'
            ],
        ];
        for ($i=0; $i < count($colors); $i++) { 
            Color::create($colors[$i]);
        }
    }
}
