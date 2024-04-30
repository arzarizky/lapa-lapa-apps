<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekaphargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekaphargas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemilik_id')->references('id')->on('pemiliks');
            $table->double('harga', 50, 0);
            $table->bigInteger('dk');
            $table->bigInteger('dp');
            $table->foreignId('useredit_id')->nullable()->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->date('tanggal');
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
        Schema::dropIfExists('rekaphargas');
    }
}
