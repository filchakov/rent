<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModificationLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modification_leads', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('lead_id')->unsigned();
            $table->foreign('lead_id')
                ->references('id')
                ->on('leads')
                ->onDelete('cascade');

            $table->integer('type_home_id')->unsigned();
            $table->foreign('type_home_id')
                ->references('id')
                ->on('type_homes')
                ->onDelete('cascade');

            $table->integer('with_owner')->default(0);

            $table->integer('with_isolated_rooms')->default(0);

            $table->integer('min_contract_day')->default(1);

            $table->integer('with_communal_fee')->default(1);

            $table->integer('with_roomated')->default(0);

            $table->integer('min_count_bed')->default(1);
            $table->integer('min_count_seats_sleep')->default(1);

            $table->integer('min_price')->default(0);
            $table->integer('max_price')->default(0);
            $table->string('currency')->default('UAH');

            $table->text('comment');

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
        Schema::drop('modification_leads');
    }
}
