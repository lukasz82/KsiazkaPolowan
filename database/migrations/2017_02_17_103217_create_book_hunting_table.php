<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookHuntingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hunting_book', function (Blueprint $table) 
        {
            $table->increments('Id');
            $table->integer('user_id');
            //$table->string('user_name');
            $table->string('hunting_authorization_id'); // pozniej zamienic na int
            $table->integer('place_of_hunting_id');
            $table->dateTimeTz('start_date');
            $table->dateTimeTz('end_date');
            $table->integer('signature_start_user_id'); // pierwszy podpis przed rozpoczęciem polowania
            $table->integer('signature_end_user_id')->nullable(); // drugi podpis po zakończeniu polowania
            $table->integer('number_of_shots')->nullable(); // ilość strzałów
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
        Schema::dropIfExists('hunting_book');
    }
}
