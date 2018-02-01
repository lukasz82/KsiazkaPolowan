<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHuntingAuthorizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hunting_authorization', function (Blueprint $table) 
        {
            $table->increments('Id');
            $table->integer('hunting_authorization_number'); // numer ścisłego zarachowania
            $table->integer('user_id'); // id użytkownika mającego upoważnienie
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
        Schema::dropIfExists('hunting_authorization'); // funkcja kasująca tabelę
    }
}
