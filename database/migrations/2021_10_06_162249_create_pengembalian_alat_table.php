<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengembalianAlatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengembalian_alat', function (Blueprint $table) {
            // $table->id();
            // $table->string('id')->primary();
            $table->integer('id')->primary();
            $table->string('id_pegawai', 20)->nullable();
            $table->foreign('id_pegawai')
                ->references('id')
                ->on('users')
                ->onDelete('set null')->onUpdate('cascade');

            $table->datetime('waktu');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengembalian_alat');
    }
}
