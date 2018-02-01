<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGPSCoordinatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('GPSCoordinates', function (Blueprint $table) 
        {
            $table->increments('Id');
            $table->double('GPS_coordinates_X'); // wspolrzedna x  
            $table->double('GPS_coordinates_Y'); // wspolrzedna y 
            $table->integer('huntingplaces_id'); // id obwodu łowieckiego
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
        Schema::dropIfExists('GPSCoordinates'); // funkcja kasująca tabelę
    }
}
