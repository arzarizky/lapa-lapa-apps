<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemiliksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemiliks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('komoditas_id')->references('id')->on('komoditas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('subkomoditas_id')->references('id')->on('subkomoditas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('kota_id')->references('id')->on('kotas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('pasar_id')->references('id')->on('jenispasars')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemiliks');
    }
}
