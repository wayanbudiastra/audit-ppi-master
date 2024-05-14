<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHandHygieneDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hand_hygiene_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('hand_hygiene_id');
            $table->integer('opportunity');
            $table->string('indication')->nullable();
            $table->string('hh_action1')->nullable();
            $table->string('hh_action2')->nullable();
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
        Schema::dropIfExists('hand_hygiene_detail');
    }
}