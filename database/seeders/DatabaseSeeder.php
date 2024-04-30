<?php

namespace Database\Seeders;

use App\Models\Subkomoditas;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            RoleSeeder::class,
            KotaSeeder::class,
            UserSeeder::class,
            JenispasarSeeder::class,
            KomoditasSeeder::class,
            SubkomoditasSeeder::class,
            KritikdansaranSeeder::class,
            PemilikSeeder::class,
            InflasiSeeder::class,
            PertumbuhanekonomiSeeder::class,
            RekaphargaSeeder::class,
        ]);
    }
}
