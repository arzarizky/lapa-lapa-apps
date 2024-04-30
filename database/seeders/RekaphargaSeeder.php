<?php

namespace Database\Seeders;

use App\Models\Pemilik;
use App\Models\Rekapharga;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RekaphargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $pemilik = Pemilik::get();

        foreach ($pemilik as $keypemilik => $valuepemilik) {

            for ($i = 400; $i > 0; $i--) {
                Rekapharga::create([
                    'pemilik_id' => $valuepemilik->id,
                    'harga' => rand(2000, 15000),
                    'dk' => rand(1, 10),
                    'dp' => rand(5, 15),
                    'tanggal' => Carbon::now()->addDay(-$i)
                ]);
            }

            Rekapharga::create([
                'pemilik_id' => $valuepemilik->id,
                'harga' => rand(2000, 15000),
                'dk' => rand(1, 10),
                'dp' => rand(5, 15),
                'tanggal' => Carbon::now()
            ]);
        }


        // Rekapharga::create([
        //     'pemilik_id' => '1',
        //     'harga' => '10000',
        //     'dk' => '10',
        //     'dp' => '15',
        //     'tanggal' => Carbon::now()->addDay(-1)
        // ]);
        // Rekapharga::create([
        //     'pemilik_id' => '1',
        //     'harga' => '20000',
        //     'dk' => '10',
        //     'dp' => '15',
        //     'tanggal' => Carbon::now()
        // ]);
        // Rekapharga::create([
        //     'pemilik_id' => '2',
        //     'harga' => '20000',
        //     'dk' => '10',
        //     'dp' => '15',
        //     'tanggal' => Carbon::now()
        // ]);
        // Rekapharga::create([
        //     'pemilik_id' => '3',
        //     'harga' => '10000',
        //     'dk' => '10',
        //     'dp' => '15',
        //     'tanggal' => Carbon::now()
        // ]);
        // Rekapharga::create([
        //     'pemilik_id' => '4',
        //     'harga' => '20000',
        //     'dk' => '10',
        //     'dp' => '15',
        //     'tanggal' => Carbon::now()
        // ]);
        // Rekapharga::create([
        //     'pemilik_id' => '5',
        //     'harga' => '10000',
        //     'dk' => '10',
        //     'dp' => '15',
        //     'tanggal' => Carbon::now()
        // ]);
        // Rekapharga::create([
        //     'pemilik_id' => '6',
        //     'harga' => '20000',
        //     'dk' => '10',
        //     'dp' => '15',
        //     'tanggal' => Carbon::now()
        // ]);
    }
}
