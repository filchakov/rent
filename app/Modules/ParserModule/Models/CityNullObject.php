<?php

namespace Modules\ParserModule\Models;

class CityNullObject extends City
{
    public function __construct()
    {
        parent::__construct(0, '');
    }

    public function toArray()
    {
        return [];
    }
}