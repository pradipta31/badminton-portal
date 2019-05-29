<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRankingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rankings', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedBigInteger('id_kategori');
          $table->unsignedBigInteger('id_atlet');
          $table->unsignedBigInteger('id_pas_atlet')->nullable();
          $table->integer('ranking');
          $table->integer('total_main');
          $table->string('total_poin');
          $table->timestamps();

          $table->foreign('id_kategori')->references('id')->on('categories')
          ->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('id_atlet')->references('id')->on('atlets')
          ->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('id_pas_atlet')->references('id')->on('atlets')
          ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rankings');
    }
}
