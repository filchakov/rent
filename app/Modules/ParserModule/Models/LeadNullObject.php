<?php

namespace Modules\ParserModule\Models;

class LeadNullObject extends Lead
{
    public function __construct()
    {
        parent::__construct(0, 0, '', 0, 0, '','');
    }

    public function toArray()
    {
        return [];
    }
}