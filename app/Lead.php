<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'donor_feed_id', 'donor_id', 'text', 'donor_created_at', 'contact_id', 'donor_type', 'city_id'
    ];
}
