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
            $table->char('nisn', 10);
            $table->char('idkelas', 12);
            $table->char('idperiode', 12);
            $table->foreign('nisn')->references('nisn')->on('siswa')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->foreign('idkelas')->references('idkelas')->on('kelas')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->foreign('idperiode')->references('idperiode')->on('periode')->onDelete('RESTRICT')->onUpdate('CASCADE');
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
