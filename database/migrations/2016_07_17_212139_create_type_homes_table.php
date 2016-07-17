<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeHomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_homes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title_ru');
            $table->string('title_uk');
            $table->string('title_en');

            $table->integer('show')->default(0);
            $table->integer('parent_id')->default(0);

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
        Schema::drop('type_homes');
    }
}
