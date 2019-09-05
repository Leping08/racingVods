<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAverageRaceLengthToSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('series', function (Blueprint $table) {
            $table->integer('min_race_time')->default(100)->after('youtube_chanel_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('series', function (Blueprint $table) {
            $table->dropColumn('min_race_time');
        });
    }
}
