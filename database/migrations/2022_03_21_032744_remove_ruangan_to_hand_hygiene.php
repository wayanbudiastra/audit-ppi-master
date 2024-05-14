<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveRuanganToHandHygiene extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hand_hygiene', function (Blueprint $table) {
            //
            $table->integer('ruangan_id')->after('periode_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hand_hygiene', function (Blueprint $table) {
            // $table->dropColumn('comment_count');
            $table->dropColumn('ruangan');
        });
    }
}