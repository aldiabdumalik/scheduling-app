<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'password' => bcrypt('12345')
        ]);

        Employee::create([
            'user_id' => $user->id,
            'name' => 'Aldi',
            'nik' => 5258,
            'whatsapp' => 6289622142528,
            'color' => '#03045E'
        ]);
    }
}
