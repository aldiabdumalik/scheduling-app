<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::truncate();
        $employee =  [
            [
                'user_id' => null,
                'name' => 'Yohana B',
                'nik' => 4416,
                'whatsapp' => 6281,
                'color' => '#03045E'
            ],
            [
                'user_id' => 1,
                'name' => 'Aldi Abdu M',
                'nik' => 5258,
                'whatsapp' => 6289622142528,
                'color' => '#FFAB76'
            ],
            [
                'user_id' => null,
                'name' => 'Hanifan Musliman',
                'nik' => 5254,
                'whatsapp' => 6282,
                'color' => '#FFFDA2'
            ],
            [
                'user_id' => null,
                'name' => 'Wildan Adji',
                'nik' => 5294,
                'whatsapp' => 6283,
                'color' => '#03045E1'
            ],
            [
                'user_id' => null,
                'name' => 'PKL',
                'nik' => 1234,
                'whatsapp' => 6284,
                'color' => '#03045E2'
            ],
            [
                'user_id' => null,
                'name' => 'Fathur Rahmanysah',
                'nik' => 5211,
                'whatsapp' => 6285,
                'color' => '#03045E3'
            ],
            [
                'user_id' => null,
                'name' => 'Fitria Sari',
                'nik' => 5172,
                'whatsapp' => 6286,
                'color' => '#03045E4'
            ],
            [
                'user_id' => null,
                'name' => 'Wildan Fathur R',
                'nik' => 5156,
                'whatsapp' => 6287,
                'color' => '#03045E5'
            ],
        ];

        for ($i=0; $i < count($employee); $i++) { 
            Employee::create($employee[$i]);
        }
    }
}
