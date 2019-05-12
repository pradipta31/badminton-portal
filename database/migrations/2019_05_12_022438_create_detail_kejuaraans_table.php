<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailKejuaraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_kejuaraans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_kejuaraan');
            $table->string('ketentuan');
            $table->string('tatacara');
            $table->timestamps();

            $table->foreign('id_kejuaraan')->references('id')->on('kejuaraans')
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
        Schema::dropIfExists('detail_kejuaraans');
    }
}
