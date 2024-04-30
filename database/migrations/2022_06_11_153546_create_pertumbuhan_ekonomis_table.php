<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePertumbuhanEkonomisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pertumbuhan_ekonomis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->double('prosentase', 5, 2);
            $table->foreignId('useradd_id')->references('id')->on('users');
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
        Schema::dropIfExists('pertumbuhan_ekonomis');
    }
}
