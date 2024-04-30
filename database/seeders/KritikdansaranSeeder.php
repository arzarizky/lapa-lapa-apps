<?php

namespace Database\Seeders;

use App\Models\Kritikdansaran;
use Illuminate\Database\Seeder;

class KritikdansaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kritikdansaran::create([
            'kota_id' => 2,
            'nama' => 'Rizky',
            'kritik' => 'Ini Kritik',
            'saran' => 'Ini saran',
        ]);
    }
}
