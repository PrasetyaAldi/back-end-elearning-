<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guru', function (Blueprint $table) {
            $table->id('idguru');
            $table->foreignId('idsekolah')->references('idsekolah')->on('sekolah')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->char('nip',18);
            $table->string('nama',255);
            $table->string('email',100);
            $table->string('password',100);
            $table->string('alamat',255);
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
        Schema::dropIfExists('guru');
    }
}
