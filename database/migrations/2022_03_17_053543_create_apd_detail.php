<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApdDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apd_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('apd_id');
            $table->string('nama_petugas');
            $table->enum('masker', ['Y', 'N'])->default('N');
            $table->enum('handschoen', ['Y', 'N'])->default('N');
            $table->enum('apron', ['Y', 'N'])->default('N');
            $table->enum('haircap', ['Y', 'N'])->default('N');
            $table->enum('google', ['Y', 'N'])->default('N');
            $table->enum('glow', ['Y', 'N'])->default('N');
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('apd_detail');
    }
}