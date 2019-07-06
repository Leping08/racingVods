<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColumnNames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tracks', function (Blueprint $table) {
            $table->renameColumn('numberOfCorners' ,'number_of_corners');
        });

        Schema::table('series', function (Blueprint $table) {
            $table->renameColumn('fullName' ,'full_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tracks', function (Blueprint $table) {
            $table->renameColumn('number_of_corners', 'numberOfCorners');
        });

        Schema::table('series', function (Blueprint $table) {
            $table->renameColumn('full_name' ,'fullNßame');
        });
    }
}
