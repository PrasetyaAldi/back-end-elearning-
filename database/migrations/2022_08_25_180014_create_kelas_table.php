<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            // $table->id('idkelas');
            $table->char('idkelas',10);
            $table->foreignId('idsekolah')->references('idsekolah')->on('sekolah')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->string('namakelas',100);
            $table->timestamps();
            $table->primary('idkelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas');
    }
}
