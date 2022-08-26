<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuangbelajarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruangbelajar', function (Blueprint $table) {
            $table->id('idrb');
            $table->foreign('idkelas')->references('idkelas')->on('kelas')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->foreignId('idmp')->references('idmp')->on('matapelajaran')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->foreignId('idperiode')->references('idperiode')->on('periode')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->foreignId('idguru')->references('idguru')->on('guru')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->string('namarb',100);
            $table->char('koderb',6);
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
        Schema::dropIfExists('ruangbelajar');
    }
}
