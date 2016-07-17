<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class LunDonor extends Model
{
    /**
     * @return Collection
     */
    public static function getSosedi(){
        $result = new LunDonor();

        return $result->where([
            'type' => 'sosedi',
            'provider' => 'lun'
        ])->get();
    }
}
