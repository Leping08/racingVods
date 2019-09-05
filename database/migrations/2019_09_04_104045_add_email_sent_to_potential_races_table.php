<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailSentToPotentialRacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('potential_races', function (Blueprint $table) {
            $table->boolean('email_sent')->default(false)->after('youtube_id');
            $table->integer('series_id')->nullable()->after('email_sent');
            $table->integer('track_id')->nullable()->after('series_id');
            $table->integer('season_id')->nullable()->after('track_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('potential_races', function (Blueprint $table) {
            $table->dropColumn('email_sent');
        });
    }
}
