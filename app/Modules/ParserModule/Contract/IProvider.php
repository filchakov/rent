<?php

namespace Modules\ParserModule\Contract;

interface IProvider
{
    public function getQuery();

    public function getLeads($offset);
    public function getLead($id);
    public function sendRequest();

}