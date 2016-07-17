<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_places', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name_ru');
            $table->string('name_uk');
            $table->string('name_en');

            $table->integer('type_place_id')->unsigned();
            $table->foreign('type_place_id')
                ->references('id')
                ->on('type_places')
                ->onDelete('cascade');

            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade');

            $table->string('alias');

            $table->integer('active')->default(0);

            $table->integer('radius')->default(2);
            
            $table->float('longitude')->default(0.0);
            $table->float('latitude')->default(0.0);

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
        Schema::drop('city_places');
    }
}
