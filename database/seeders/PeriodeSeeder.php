<?php

namespace Database\Seeders;

use App\Models\Master\Periode;
use Illuminate\Database\Seeder;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Periode::create(['tahun_id' => 1, 'nama_periode' => 'Maret 2022', 'index_bulan' => '3']);
        Periode::create(['tahun_id' => 1, 'nama_periode' => 'April 2022', 'index_bulan' => '4']);
        Periode::create(['tahun_id' => 1, 'nama_periode' => 'Mei 2022', 'index_bulan' => '5']);
    }
}