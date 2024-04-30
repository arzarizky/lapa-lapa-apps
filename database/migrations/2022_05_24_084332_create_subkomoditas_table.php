<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSubkomoditasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('subkomoditas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('komoditas_id')->references('id')->on('komoditas')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama');
            $table->string('foto');
            $table->string('satuan');
            $table->date('tanggal')->default(date("Y-m-d H:i:s"));
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
        Schema::dropIfExists('subkomoditas');
    }
}
