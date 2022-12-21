<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosaPenghuni extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('askep_diagnosa_penghuni', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_penghuni')->nullable();
            $table->foreign('id_penghuni')
                ->references('id')
                ->on('penghuni')
                ->onDelete('set null')->onUpdate('cascade');
            $table->unsignedInteger('id_diagnosa')->nullable();
            $table->foreign('id_diagnosa')
                ->references('id')
                ->on('askep_diagnosa')
                ->onDelete('set null')->onUpdate('cascade');
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
        Schema::dropIfExists('askep_diagnosa_penghuni');
    }
}
