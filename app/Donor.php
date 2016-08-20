<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{

    /**
     * @return Collection
     */
    public function getWallsVk(){
        return $this->where([
                'provider' => 'vk',
                'type' => 'wall'
        ]);
    }

    /**
     * @return Collection
     */
    public function getBoardsVk(){
        return $this->where([
            'provider' => 'vk',
            'type' => 'board'
        ]);
    }
}
