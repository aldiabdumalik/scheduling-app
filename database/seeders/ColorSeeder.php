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
                'code' => '#03045E'
            ],
            [
                'code' => '#FFAB76'
            ],
            [
                'code' => '#FFFDA2'
            ],
            [
                'code' => '#85F4FF'
            ],
            [
                'code' => '#00C897'
            ],
            [
                'code' => '#FF8AAE'
            ],
            [
                'code' => '#DA1212'
            ],
            [
                'code' => '#6E3CBC'
            ],
            [
                'code' => '#EEEEEE'
            ],
            [
                'code' => '#FAFF00'
            ],
            [
                'code' => '#B3541E'
            ],
            [
                'code' => '#502064'
            ],
            [
                'code' => '#C6D57E'
            ],
        ];
        for ($i=0; $i < count($colors); $i++) { 
            Color::create($colors[$i]);
        }
    }
}
