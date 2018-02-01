<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForestryNameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forestry_name', function (Blueprint $table) 
        {
            $table->increments('Id');
            $table->string('forestry_name'); // nazwa nadleśnictwa
            $table->string('city'); // miasto
            $table->string('postal_code'); // kod pocztowy
            $table->string('street_name'); // ul. nazwa
            $table->string('street_number'); // ul. numer
            $table->string('email'); 
            $table->string('website'); // strona
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
        Schema::dropIfExists('forestry_name'); // funkcja kasująca tabelę
    }
}
