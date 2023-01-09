<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGejalaDiagnosaPenghuni extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('askep_gejala_diagnosa_penghuni', function (Blueprint $table) {
      $table->increments('id');
      $table->unsignedInteger('id_diagnosa_penghuni')->nullable();
      $table->foreign('id_diagnosa_penghuni')
        ->references('id')
        ->on('askep_diagnosa_penghuni')
        ->onDelete('set null')->onUpdate('cascade');
      $table->unsignedInteger('id_gejala')->nullable();
      $table->foreign('id_gejala')
        ->references('id')
        ->on('askep_gejala_diagnosa')
        ->onDelete('set null')->onUpdate('cascade');
      $table->string('id_pegawai', 20)->nullable();
      $table->foreign('id_pegawai')
        ->references('id')
        ->on('users')
        ->onDelete('set null')->onUpdate('cascade');
      $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->unique(['id_diagnosa_penghuni', 'id_gejala', 'id_pegawai'], 'unique_gejala_diagnosa_penghuni');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('askep_gejala_diagnosa_penghuni');
  }
}
