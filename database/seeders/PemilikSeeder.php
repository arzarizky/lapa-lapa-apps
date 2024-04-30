<?php

namespace Database\Seeders;

use App\Models\Jenispasar;
use App\Models\Komoditas;
use App\Models\Kota;
use App\Models\Pemilik;
use App\Models\Subkomoditas;
use Illuminate\Database\Seeder;

class PemilikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $komoditas = Komoditas::get();
        $subkomoditas = Subkomoditas::get();
        $kota = Kota::get();
        $jenispasar = Jenispasar::get();

        foreach ($kota as $keykota => $valuekota) {
            foreach ($subkomoditas as $keysubkomoditas => $valuesubkomoditas) {
                foreach ($jenispasar as $keyjenispasar => $valuejenispasar) {
                    Pemilik::create(['komoditas_id' => $valuesubkomoditas->komoditas_id, 'subkomoditas_id' => $valuesubkomoditas->id, 'kota_id' => $valuekota->id, 'pasar_id' => $valuejenispasar->id]);
                }
            }
        }


        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '1', 'kota_id' => '1', 'pasar_id' => '1']);
        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '2', 'kota_id' => '1', 'pasar_id' => '1']);
        // Pemilik::create(['komoditas_id' => '2', 'subkomoditas_id' => '3', 'kota_id' => '1', 'pasar_id' => '1']);
        // Pemilik::create(['komoditas_id' => '2', 'subkomoditas_id' => '4', 'kota_id' => '1', 'pasar_id' => '1']);

        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '1', 'kota_id' => '2', 'pasar_id' => '1']);
        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '2', 'kota_id' => '2', 'pasar_id' => '1']);

        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '1', 'kota_id' => '3', 'pasar_id' => '1']);
        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '2', 'kota_id' => '3', 'pasar_id' => '1']);

        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '1', 'kota_id' => '4', 'pasar_id' => '1']);
        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '2', 'kota_id' => '4', 'pasar_id' => '1']);

        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '1', 'kota_id' => '5', 'pasar_id' => '1']);
        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '2', 'kota_id' => '5', 'pasar_id' => '1']);

        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '1', 'kota_id' => '6', 'pasar_id' => '1']);
        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '2', 'kota_id' => '6', 'pasar_id' => '1']);

        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '1', 'kota_id' => '7', 'pasar_id' => '1']);
        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '2', 'kota_id' => '7', 'pasar_id' => '1']);

        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '1', 'kota_id' => '8', 'pasar_id' => '1']);
        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '2', 'kota_id' => '8', 'pasar_id' => '1']);

        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '1', 'kota_id' => '9', 'pasar_id' => '1']);
        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '2', 'kota_id' => '9', 'pasar_id' => '1']);

        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '1', 'kota_id' => '10', 'pasar_id' => '1']);
        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '2', 'kota_id' => '10', 'pasar_id' => '1']);

        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '1', 'kota_id' => '11', 'pasar_id' => '1']);
        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '2', 'kota_id' => '11', 'pasar_id' => '1']);

        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '1', 'kota_id' => '12', 'pasar_id' => '1']);
        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '2', 'kota_id' => '12', 'pasar_id' => '1']);

        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '1', 'kota_id' => '13', 'pasar_id' => '1']);
        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '2', 'kota_id' => '13', 'pasar_id' => '1']);

        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '1', 'kota_id' => '14', 'pasar_id' => '1']);
        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '2', 'kota_id' => '14', 'pasar_id' => '1']);

        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '1', 'kota_id' => '15', 'pasar_id' => '1']);
        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '2', 'kota_id' => '15', 'pasar_id' => '1']);

        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '1', 'kota_id' => '16', 'pasar_id' => '1']);
        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '2', 'kota_id' => '16', 'pasar_id' => '1']);

        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '1', 'kota_id' => '17', 'pasar_id' => '1']);
        // Pemilik::create(['komoditas_id' => '1', 'subkomoditas_id' => '2', 'kota_id' => '17', 'pasar_id' => '1']);
    }
}
