<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('version_id')->nullable();
            $table->string('track_spotify_id');
            $table->string('track_name');
            $table->string('track_artist');
            $table->text('track_data');
            $table->integer('position')->nullable();
            $table->integer('total_points')->nullable();
            $table->integer('last_position')->nullable();
            $table->integer('periods_on_chart')->nullable();
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
        Schema::dropIfExists('charts');
    }
}
