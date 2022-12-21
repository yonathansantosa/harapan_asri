<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelationIdlevelRoleUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('id_level')->nullable()
                ->after('id');

            //default onDelete and onUpdate RESTRICT
            $table->foreign('id_level')
                ->references('id')
                ->on('role_users')
                ->onDelete('set null')->onUpdate('cascade');
            // ->onUpdate('cascade')
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
