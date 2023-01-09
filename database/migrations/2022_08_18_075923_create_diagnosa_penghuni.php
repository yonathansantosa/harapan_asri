<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
      $table->string('id_pegawai', 20)->nullable();
      $table->foreign('id_pegawai')
        ->references('id')
        ->on('users')
        ->onDelete('set null')->onUpdate('cascade');
      $table->string('id_pj_1', 20)->nullable();
      $table->foreign('id_pj_1')
        ->references('id')
        ->on('users')
        ->onDelete('set null')->onUpdate('cascade');
      $table->string('id_pj_2', 20)->nullable();
      $table->foreign('id_pj_2')
        ->references('id')
        ->on('users')
        ->onDelete('set null')->onUpdate('cascade');
      $table->string('id_pj_3', 20)->nullable();
      $table->foreign('id_pj_3')
        ->references('id')
        ->on('users')
        ->onDelete('set null')->onUpdate('cascade');
      $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
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
