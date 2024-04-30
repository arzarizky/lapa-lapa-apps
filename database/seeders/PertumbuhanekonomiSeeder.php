<?php

namespace Database\Seeders;

use App\Models\PertumbuhanEkonomi;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PertumbuhanekonomiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 24; $i > 0;) {
            PertumbuhanEkonomi::create([
                'tanggal' => Carbon::now()->addMonth(-$i),
                'prosentase' => rand(1, 100),
                'useradd_id' => '1',
            ]);
            $i -= 3;
        }
        PertumbuhanEkonomi::create([
            'tanggal' => Carbon::now(),
            'prosentase' => rand(1, 100),
            'useradd_id' => '1',
        ]);
    }
}
