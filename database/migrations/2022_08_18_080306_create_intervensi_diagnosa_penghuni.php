<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntervensiDiagnosaPenghuni extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('askep_intervensi_diagnosa_penghuni', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_diagnosa_penghuni')->nullable();
            $table->foreign('id_diagnosa_penghuni')
                ->references('id')
                ->on('askep_diagnosa_penghuni')
                ->onDelete('set null')->onUpdate('cascade');
            $table->unsignedInteger('id_intervensi')->nullable();
            $table->foreign('id_intervensi')
                ->references('id')
                ->on('askep_intervensi_diagnosa')
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
        Schema::dropIfExists('askep_intervensi_diagnosa_penghuni');
    }
}
