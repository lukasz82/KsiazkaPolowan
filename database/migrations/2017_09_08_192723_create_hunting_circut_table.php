<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHuntingCircutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hunting_circut', function (Blueprint $table) 
        {
            $table->increments('Id');
            $table->integer('hunting_circut_number'); // numer obwodu
            $table->integer('forestry_name_id'); // przynależność do nadleśnictwa
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
        Schema::dropIfExists('hunting_circut'); // funkcja kasująca tabelę
    }
}
