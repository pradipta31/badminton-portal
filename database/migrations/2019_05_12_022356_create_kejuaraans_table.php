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
          $table->string('nama_kejuaraan');
          $table->string('kategori');
          $table->string('kabupaten');
          $table->date('tgl_mulai')->nullable();
          $table->date('tgl_akhir');
          $table->string('hadiah')->nullable();
          $table->date('batas_pendaftaran')->nullable();
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
