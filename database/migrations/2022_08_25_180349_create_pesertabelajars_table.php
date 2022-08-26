<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertabelajarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesertabelajar', function (Blueprint $table) {
            $table->id('idpb');
            $table->foreignId('idsiswa')->references('idsiswa')->on('siswa')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->foreign('idkelas')->references('idkelas')->on('kelas')->onDelete('RESTRICT')->onUpdate('CASCADE');    
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
        Schema::dropIfExists('pesertabelajar');
    }
}
