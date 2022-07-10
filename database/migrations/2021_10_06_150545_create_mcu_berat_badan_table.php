<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcuBeratBadanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcu_berat_badan', function (Blueprint $table) {
            // $table->id();
            $table->increments('id');
            $table->string('id_pegawai', 20)->nullable();
            $table->foreign('id_pegawai')
                ->references('id')
                ->on('users')
                ->onDelete('set null')->onUpdate('cascade');

            $table->unsignedInteger('id_penghuni')->nullable();
            $table->foreign('id_penghuni')
                ->references('id')
                ->on('penghuni')
                ->onDelete('set null')->onUpdate('cascade');

            $table->float('hasil', 5, 2);
            $table->datetime('waktu');

            $table->integer('deleted')->unsigned()->nullable()->default(0);

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
        Schema::dropIfExists('mcu_berat_badan');
    }
}
