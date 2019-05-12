<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKejuaraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kejuaraans', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('judul');
          $table->string('kategori');
          $table->string('kabupaten');
          $table->string('provinsi');
          $table->string('hadiah')->nullable();
          $table->date('batas_pendaftaran')->nullable();
          $table->string('hasil_pertandingan')->nullable();
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
        Schema::dropIfExists('kejuaraans');
    }
}
