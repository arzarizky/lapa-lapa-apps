<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = User::create([
            'name' => 'Super Admin',
            'last_name' => 'Super Admin',
            'email' => 'supersekali@gmail.com',
            'password' => Hash::make('admin123'),
            'kota_id' => 1,
        ]);
        $data->assignRole('Super Admin');
        $data = User::create([
            'name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'kota_id' => 2,
        ]);
        $data->assignRole('Admin');
    }
}
