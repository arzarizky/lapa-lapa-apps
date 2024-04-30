<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKritikdansaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kritikdansarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kota_id')->references('id')->on('kotas')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama');
            $table->string('kritik');
            $table->string('saran');
            $table->enum('status', ['Belum Dibaca', 'Sudah Dibaca'])->default('Belum Dibaca');
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
        Schema::dropIfExists('kritikdansarans');
    }
}
