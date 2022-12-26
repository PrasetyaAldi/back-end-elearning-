<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periode', function (Blueprint $table) {
            $table->char('idperiode', 12)->primary();
            $table->char('npsn', 8);
            $table->foreign('npsn')->references('npsn')->on('sekolah')->restrictOnDelete()->cascadeOnUpdate();
            $table->string('namaperiode', 100);
            $table->date('tanggalawal');
            $table->date('tanggalakhir');
            $table->char('isaktif', 1)->default('1');
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
        Schema::dropIfExists('periode');
    }
}
