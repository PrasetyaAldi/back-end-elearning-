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
            $table->char('npsn',8);
            $table->foreign('npsn')->references('npsn')->on('sekolah')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->char('nip',18)->unique();
            $table->string('nama',255);
            $table->string('email',100)->unique();
            $table->string('password',100);
        $table->text('alamat');
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
