<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSekolahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sekolah', function (Blueprint $table) {
            $table->bigInteger('idsekolah', true);
            $table->char('npsn', 8)->primary();
            $table->string('nama', 255);
            $table->string('email', 100)->unique();
            $table->string('password', 100);
            $table->text('alamat');
            $table->char('kodesekolah', 6);
            $table->dropPrimary('sekolah_idsekolah_primary');
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
        Schema::dropIfExists('sekolah');
    }
}
