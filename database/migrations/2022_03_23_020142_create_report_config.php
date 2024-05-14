<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_config', function (Blueprint $table) {
            $table->id();
            $table->integer('hh_rekap_permoment')->default(1);
            $table->integer('hh_rekap_perruangan')->default(1);
            $table->integer('hh_rekap_perperiode')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_config');
    }
}