<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeletes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('races', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('seasons', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('series', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('tracks', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('videos', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('races', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('seasons', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('series', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('tracks', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('videos', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
