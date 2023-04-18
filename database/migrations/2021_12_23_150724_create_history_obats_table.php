<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryObatsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('tb_history_obat', function (Blueprint $table) {
      $table->increments('id');
      $table->unsignedInteger('id_obat')->nullable();
      $table->unsignedInteger('id_penghuni')->nullable();
      $table->foreign('id_penghuni')
        ->references('id')
        ->on('penghuni')
        ->onDelete('set null')->onUpdate('cascade');
      $table->string('keterangan')->default(' ');
      $table->timestamp('created_at')->useCurrent();
      $table->timestamp('updated_at')->useCurrent();
      $table->integer('stokobat')->default(0);
      $table->integer('deleted')->default(0);

      $table->foreign('id_obat')->references('id')->on('tb_obat')->onDelete('set null')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('tb_history_obat', function (Blueprint $table) {
      $table->dropForeign(['id_obat']);
    });
  }
}
