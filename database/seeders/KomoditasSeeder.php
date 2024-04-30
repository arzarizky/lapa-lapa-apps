<?php

namespace Database\Seeders;

use App\Models\Komoditas;
use Illuminate\Database\Seeder;

class KomoditasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Komoditas::create([
            'nama' => 'Beras'
        ]);
        Komoditas::create([
            'nama' => 'Daging Ayam'
        ]);
        Komoditas::create([
            'nama' => 'Daging Sapi'
        ]);
        Komoditas::create([
            'nama' => 'Telur Ayam'
        ]);
        Komoditas::create([
            'nama' => 'Bawang Merah'
        ]);
        Komoditas::create([
            'nama' => 'Bawang Putih'
        ]);
        Komoditas::create([
            'nama' => 'Cabai Merah'
        ]);
        Komoditas::create([
            'nama' => 'Cabai Rawit'
        ]);
        Komoditas::create([
            'nama' => 'Minyak Goreng'
        ]);
        Komoditas::create([
            'nama' => 'Gula Pasir'
        ]);
        Komoditas::create([
            'nama' => 'Ikan'
        ]);
    }
}
