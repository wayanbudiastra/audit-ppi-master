<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRenameProfesiIdToHandHygiene extends Migration
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
            $table->integer('profesi_id')->after('ruangan_id');
            $table->removeColumn('profesi');
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
            //
        });
    }
}
