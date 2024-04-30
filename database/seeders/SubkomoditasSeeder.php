<?php

namespace Database\Seeders;

use App\Models\Subkomoditas;
use Illuminate\Database\Seeder;

class SubkomoditasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subkomoditas::create([
            'komoditas_id' => '1',
            'nama' => 'Beras Kualitas Bawah',
            'foto' => 'Beras_Kualitas_Bawah.png',
            'satuan' => 'KG'
        ]);
        Subkomoditas::create([
            'komoditas_id' => '1',
            'nama' => 'Beras Kualitas Medium',
            'foto' => 'Beras_Kualitas_Medium.png',
            'satuan' => 'KG'
        ]);
        Subkomoditas::create([
            'komoditas_id' => '1',
            'nama' => 'Beras Kualitas Super',
            'foto' => 'Beras_Kualitas_Super.png',
            'satuan' => 'KG'
        ]);
        Subkomoditas::create([
            'komoditas_id' => '2',
            'nama' => 'Daging Ayam Ras',
            'foto' => 'Daging_Ayam_Ras.png',
            'satuan' => 'KG'
        ]);
        Subkomoditas::create([
            'komoditas_id' => '3',
            'nama' => 'Daging Sapi Kualitas',
            'foto' => 'Daging_Sapi_Kualitas.png',
            'satuan' => 'KG'
        ]);
        Subkomoditas::create([
            'komoditas_id' => '4',
            'nama' => 'Telur Ayam Ras',
            'foto' => 'Telur_Ayam_Ras.png',
            'satuan' => 'KG'
        ]);
        Subkomoditas::create([
            'komoditas_id' => '5',
            'nama' => 'Bawang Merah',
            'foto' => 'Bawang_Merah.png',
            'satuan' => 'KG'
        ]);
        Subkomoditas::create([
            'komoditas_id' => '6',
            'nama' => 'Bawang Putih',
            'foto' => 'Bawang_Putih.png',
            'satuan' => 'KG'
        ]);
        Subkomoditas::create([
            'komoditas_id' => '7',
            'nama' => 'Cabai Merah Besar',
            'foto' => 'Cabai_Merah_Besar.png',
            'satuan' => 'KG'
        ]);
        Subkomoditas::create([
            'komoditas_id' => '7',
            'nama' => 'Cabai Merah Keriting',
            'foto' => 'Cabai_Merah_Keriting.png',
            'satuan' => 'KG'
        ]);
        Subkomoditas::create([
            'komoditas_id' => '8',
            'nama' => 'Cabai Rawit Hijau',
            'foto' => 'Cabai_Rawit_Hijau.png',
            'satuan' => 'KG'
        ]);
        Subkomoditas::create([
            'komoditas_id' => '8',
            'nama' => 'Cabai Rawit Merah',
            'foto' => 'Cabai_Rawit_Merah.png',
            'satuan' => 'KG'
        ]);
        Subkomoditas::create([
            'komoditas_id' => '9',
            'nama' => 'Minyak Curah',
            'foto' => 'Curah.png',
            'satuan' => 'Liter'
        ]);
        Subkomoditas::create([
            'komoditas_id' => '9',
            'nama' => 'Minyak Premium',
            'foto' => 'Premium.png',
            'satuan' => 'Liter'
        ]);
        Subkomoditas::create([
            'komoditas_id' => '10',
            'nama' => 'Gula Lokal (kemasan plastik biasa)',
            'foto' => 'Lokal_(kemasan_plastik_biasa).png',
            'satuan' => 'KG'
        ]);
        Subkomoditas::create([
            'komoditas_id' => '10',
            'nama' => 'Gula Premium (kemasan Pabrik)',
            'foto' => 'Premium_(kemasan_Pabrik).png',
            'satuan' => 'KG'
        ]);
        Subkomoditas::create([
            'komoditas_id' => '11',
            'nama' => 'Ikan Sunu',
            'foto' => 'Sunu.png',
            'satuan' => 'KG'
        ]);
        Subkomoditas::create([
            'komoditas_id' => '11',
            'nama' => 'Ikan Kembung',
            'foto' => 'Kembung.png',
            'satuan' => 'KG'
        ]);
        Subkomoditas::create([
            'komoditas_id' => '11',
            'nama' => 'Ikan Bandeng',
            'foto' => 'Bandeng.png',
            'satuan' => 'KG'
        ]);
    }
}
