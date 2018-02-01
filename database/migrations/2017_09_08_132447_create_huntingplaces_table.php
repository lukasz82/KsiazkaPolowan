<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHuntingplacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hunting_places', function (Blueprint $table) 
        {
            $table->increments('Id');
            $table->integer('vivodeship_id'); // województwo
            $table->integer('forestry_name_id'); // nadleśnictwo
            $table->integer('hunting_circuit_id'); // obwód łowiecki
            //$table->integer('GPS_coordinates_id'); // współrzędne GPS będą w osobnej tablicy
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
        Schema::dropIfExists('hunting_places');
    }
}
