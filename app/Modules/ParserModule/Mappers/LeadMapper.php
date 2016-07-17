<?php

namespace Modules\ParserModule\Mappers;

use Carbon\Carbon;

use Modules\ParserModule\Models\ContactNullObject;
use Modules\ParserModule\Models\Lead;
use Modules\ParserModule\Models\LeadNullObject;

class LeadMapper
{
    const ID = 'id';
    const TEXT = 'text';
    const DONOR_ID = 'donor_id';

    const CITY_ID = 'city_id';
    const CONTACT_ID = 'contact_id';

    const DONOR_TYPE = 'donor_type';
    const CREATED_AT = 'date';

    public function buildObject($leadArray){
        if(empty($leadArray)){
            return new LeadNullObject();
        } else {
            return new Lead(
                $leadArray[self::ID],
                $leadArray[self::DONOR_ID],
                $leadArray[self::TEXT],
                $leadArray[self::CITY_ID],
                $leadArray[self::CONTACT_ID],
                $leadArray[self::DONOR_TYPE],
                Carbon::createFromTimestampUTC($leadArray[self::CREATED_AT])->toDateTimeString()
            );
        }
    }
}