<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHuntedAnimalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hunted_animals', function (Blueprint $table) 
        {
            $table->increments('Id');
            $table->integer('hunting_id'); // odwołanie do numeru polowania
            $table->integer('kind_id'); // gatunek
            $table->integer('quantity'); // ilość upolowanej zwierzyny
            // Ilość strzałów będzie ogólnie dla całego polowania w hunting book table, chyba, że okaże się że dla każdego zwierzaka osobno to zmienimy
            //$table->integer('number_of_shots'); // ilość strzałów
            $table->string('animal_sex'); // płeć upolowanej zwierzyny
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
        Schema::dropIfExists('hunted_animals');
    }
}
