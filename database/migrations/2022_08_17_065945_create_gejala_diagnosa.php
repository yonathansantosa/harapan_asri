<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGejalaDiagnosa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('askep_gejala_diagnosa', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_diagnosa')->nullable();
            $table->foreign('id_diagnosa')
                ->references('id')
                ->on('askep_diagnosa')
                ->onDelete('set null')->onUpdate('cascade');
            $table->string('gejala');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('askep_gejala_diagnosa');
    }
}
