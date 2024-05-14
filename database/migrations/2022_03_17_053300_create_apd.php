<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apd', function (Blueprint $table) {
            $table->id();
            $table->string('nama_auditor');
            $table->string('ruangan')->nullable();
            $table->string('auditor')->nullable();
            $table->integer('periode_id');
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
        Schema::dropIfExists('apd');
    }
}