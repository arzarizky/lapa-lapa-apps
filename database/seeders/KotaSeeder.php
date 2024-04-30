<?php

namespace Database\Seeders;

use App\Models\Kota;
use Illuminate\Database\Seeder;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kota::create([
            'nama' => 'Kota Kendari'
        ]);
        Kota::create([
            'nama' => 'Kota Baubau'
        ]);
        Kota::create([
            'nama' => 'Kabupaten Kolaka'
        ]);
        Kota::create([
            'nama' => 'Kabupaten Kolaka Timur'
        ]);
        Kota::create([
            'nama' => 'Kabupaten Kolaka Utara'
        ]);
        Kota::create([
            'nama' => 'Kabupaten Muna'
        ]);
        Kota::create([
            'nama' => 'Kabupaten Muna Barat'
        ]);
        Kota::create([
            'nama' => 'Kabupaten Konawe'
        ]);
        Kota::create([
            'nama' => 'Kabupaten Konawe Selatan'
        ]);
        Kota::create([
            'nama' => 'Kabupaten Konawe Utara'
        ]);
        Kota::create([
            'nama' => 'Kabupaten Konawe Kepulauan'
        ]);
        Kota::create([
            'nama' => 'Kabupaten Buton'
        ]);
        Kota::create([
            'nama' => 'Kabupaten Buton Selatan'
        ]);
        Kota::create([
            'nama' => 'Kabupaten Buton Tengah'
        ]);
        Kota::create([
            'nama' => 'Kabupaten Buton Utara'
        ]);
        Kota::create([
            'nama' => 'Kabupaten Bombana'
        ]);
        Kota::create([
            'nama' => 'Kabupaten Wakatobi'
        ]);
    }
}
