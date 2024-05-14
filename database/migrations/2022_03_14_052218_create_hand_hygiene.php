<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHandHygiene extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hand_hygiene', function (Blueprint $table) {
            $table->id();
            $table->string('periode_id');
            $table->string('ruangan');
            $table->string('lantai');
            $table->string('profesi');
            $table->string('waktu_start');
            $table->string('waktu_end')->nullable();
            $table->enum('posting', ['Y', 'N'])->default('N');
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
        Schema::dropIfExists('hand_hygiene');
    }
}