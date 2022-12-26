<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBahanajarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bahanajar', function (Blueprint $table) {
            $table->id('idbahanajar');
            $table->foreignId('idrb')->references('idrb')->on('ruangbelajar')->restrictOnDelete()->cascadeOnUpdate();
            $table->string('namafile', 100)->nullable();
            $table->char('istugas', 1);
            $table->string('file')->nullable();
            $table->date('deadline')->nullable();
            $table->text('deskripsi');
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
        Schema::dropIfExists('bahanajar');
    }
}
