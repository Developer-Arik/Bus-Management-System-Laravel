<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSceduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scedule', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departure_id');
            $table->foreignId('destination_id');
            $table->time('departure_time');
            $table->foreignId('bus_id');
            $table->integer('seat_fare');
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
        Schema::dropIfExists('scedule');
    }
}
