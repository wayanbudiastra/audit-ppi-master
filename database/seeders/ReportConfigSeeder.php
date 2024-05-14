<?php

namespace Database\Seeders;

use App\Models\Setting\Report_config;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;

class ReportConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Report_config::create([
            "hh_rekap_permoment" => 1,
        ]);
    }
}