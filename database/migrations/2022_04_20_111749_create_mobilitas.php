<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobilitas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobilitas', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('id_penghuni')->nullable();
            $table->foreign('id_penghuni')
                ->references('id')
                ->on('penghuni')
                ->onDelete('set null')->onUpdate('cascade');

            $table->string('tujuan');

            $table->datetime('keluar')->useCurrent();
            $table->datetime('kembali')->nullable();

            $table->string('petugas_keluar', 20)->nullable();
            $table->foreign('petugas_keluar')
                ->references('id')
                ->on('users')
                ->onDelete('set null')->onUpdate('cascade');

            $table->string('petugas_kembali', 20)->nullable();
            $table->foreign('petugas_kembali')
                ->references('id')
                ->on('users')
                ->onDelete('set null')->onUpdate('cascade');

            $table->datetime('timestamp_keluar')->useCurrent();
            $table->datetime('timestamp_kembali')->nullable();

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
        Schema::dropIfExists('mobilitas');
    }
}
