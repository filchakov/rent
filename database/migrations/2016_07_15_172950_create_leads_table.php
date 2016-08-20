<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');

            $table->string('donor_type');

            $table->integer('donor_feed_id')->default(0);
            $table->integer('donor_id')->default(0);
            $table->text('text');
            $table->integer('city_id')->default(0);
            $table->integer('contact_id')->default(0);

            $table->integer('is_moderate')->default(0);

            $table->timestamp('disable_lead_time')->nullable();
            $table->integer('count_prolong')->default(1);

            $table->timestamp('checkin_time')->default(NULL);

            $table->integer('count_adult_people')->default(1);
            $table->integer('with_children')->default(0);
            $table->integer('with_animal')->default(0);

            $table->integer('is_smoking')->default(0);
            $table->integer('is_drink')->default(0);
            $table->integer('is_vegetarian')->default(0);

            $table->integer('with_repair')->default(1); // c ремонтом
            $table->integer('with_lift')->default(1);
            $table->integer('with_internet')->default(1);
            $table->integer('with_conditioner')->default(0);
            $table->integer('with_strong_door')->default(0);
            $table->integer('with_refrigerator')->default(1);

            $table->integer('include_first_floor')->default(1);
            $table->integer('with_good_view')->default(0); //хороший вид из окон

            $table->integer('is_minimalism')->default(0); //мебель
            $table->integer('with_furniture')->default(1); //мебель
            $table->integer('new_furniture')->default(0);

            $table->integer('with_washing')->default(1);

            $table->integer('is_studio')->default(0);

            $table->integer('new_building')->default(0);
            $table->integer('new_techniques')->default(0); //новая сантехника

            $table->integer('with_parking')->default(0);

            $table->integer('is_separated_bedroom')->default(1);




            //Тип животных
                //Кошка
                //Собака
                //Попугай
                //Грызун
                //Рыбки
                //Другое

            //Тип жилья
                //Подселение к комнату
                //Отдельная комната
                //Квартира
                //Дом

                //С хозяином?
                    //Без
                    //С хозяином

                //Количество комнат
                    //1
                    //2
                    //3
                    //4
                    //Не важно

                //Количество спальных мест
                    //1
                    //2
                    //3
                    //4
                    //5
                    //6
                    //Не важно

                //Бюджет
                    //Минимальный
                    //Максимальный
                    //Валюта

                //Коммуналка
                    //Включена в стоимость
                    //Коммуналка отдельно

            //Район
                //Перечисление районов

            $table->timestamp('donor_created_at')->nullable();

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
        Schema::drop('leads');
    }
}
