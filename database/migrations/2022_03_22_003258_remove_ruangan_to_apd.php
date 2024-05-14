<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveRuanganToApd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apd', function (Blueprint $table) {
            $table->dropColumn('ruangan');
            $table->integer('ruangan_id')->after('nama_auditor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apd', function (Blueprint $table) {
            //
        });
    }
}