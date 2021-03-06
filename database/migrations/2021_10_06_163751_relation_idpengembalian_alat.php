<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelationIdpengembalianAlat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peminjaman_alat', function (Blueprint $table) {
            $table->integer('id_pengembalian_alat')
                ->after('ukuran')->nullable();
            $table->foreign('id_pengembalian_alat')
                ->references('id')
                ->on('pengembalian_alat')
                ->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('peminjaman_alat', function (Blueprint $table) {
            //
        });
    }
}
