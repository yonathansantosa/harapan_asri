<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyebabDiagnosaPenghuni extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('askep_penyebab_diagnosa_penghuni', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_diagnosa_penghuni')->nullable();
            $table->foreign('id_diagnosa_penghuni')
                ->references('id')
                ->on('askep_diagnosa_penghuni')
                ->onDelete('set null')->onUpdate('cascade');
            $table->unsignedInteger('id_penyebab')->nullable();
            $table->foreign('id_penyebab')
                ->references('id')
                ->on('askep_penyebab_diagnosa')
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
        Schema::dropIfExists('askep_penyebab_diagnosa_penghuni');
    }
}
