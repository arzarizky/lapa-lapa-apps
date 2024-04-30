<?php

namespace Database\Seeders;

use App\Models\Jenispasar;
use Illuminate\Database\Seeder;

class JenispasarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jenispasar::create([
            'nama' => 'Pasar Modern',
        ]);
        Jenispasar::create([
            'nama' => 'Pasar Tradisional',
        ]);
    }
}
