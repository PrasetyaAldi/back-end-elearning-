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
            $table->string('idguru', 9)->primary();
            $table->char('npsn', 8);
            $table->foreign('npsn')->references('npsn')->on('sekolah')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->char('nip', 18)->unique()->nullable();
            $table->string('nama', 255);
            $table->text('alamat')->nullable();
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
