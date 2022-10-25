<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->bigInteger('idsiswa');
            $table->char('npsn',8);
            $table->foreign('npsn')->references('npsn')->on('sekolah')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->char('nisn',10)->primary();
            $table->string('nama',255);
            $table->string('email',100)->unique();
            $table->string('password',100);
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
        Schema::dropIfExists('siswa');
    }
}
