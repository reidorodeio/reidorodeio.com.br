<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fantasy_event_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('capitao_id');
            $table->unsignedBigInteger('meio1_id');
            $table->unsignedBigInteger('meio2_id');
            $table->unsignedBigInteger('presilha_id');
            $table->boolean('pago')->default(false);
            $table->timestamps();
    
            // Chaves estrangeiras
            $table->foreign('fantasy_event_id')->references('id')->on('fantasy_events')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
