<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaitugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilaitugas', function (Blueprint $table) {
            $table->id('idnilai');
            $table->char('nisn',10);
            $table->foreign('nisn')->references('nisn')->on('siswa')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('idbahanajar')->references('idbahanajar')->on('bahanajar')->cascadeOnUpdate()->restrictOnDelete();
            $table->integer('nangka');
            $table->char('nhuruf',1)->nullable();
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
        Schema::dropIfExists('nilaitugas');
    }
}
