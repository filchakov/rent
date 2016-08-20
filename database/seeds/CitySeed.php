<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('cities')->truncate();

        $city = new \App\City();
        $city->id = 1;
        $city->name_ru = 'Киев';
        $city->name_uk = 'Київ';
        $city->name_en = 'Kiev';
        $city->alias = 'kiev';
        $city->active = 1;
        $city->latitude = '50.4501';
        $city->longitude = '30.5234';
        $city->save();

        $city = new \App\City();
        $city->id = 2;
        $city->name_ru = 'Харьков';
        $city->name_uk = 'Харків';
        $city->name_en = 'Kharkov';
        $city->alias = 'kharkov';
        $city->active = 1;
        $city->latitude = '49.9935';
        $city->longitude = '36.2304';
        $city->save();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
