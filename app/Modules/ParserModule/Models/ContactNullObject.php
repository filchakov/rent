<?php

namespace Modules\ParserModule\Models;

class ContactNullObject extends Contact
{
    public function __construct()
    {
        parent::__construct(0, '', '', '', '', new CityNullObject(), '', '', '');
    }

    public function toArray()
    {
        return [];
    }
}