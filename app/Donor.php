<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{

    /**
     * @return Collection
     */
    public static function getWallsVk(){
        $result = new Donor();

        return $result->where([
                'provider' => 'vk',
                'type' => 'wall'
            ])->get();
    }

    /**
     * @return Collection
     */
    public static function getBoardsVk(){
        $result = new Donor();

        return $result->where([
            'provider' => 'vk',
            'type' => 'board'
        ])->get();
    }
}
