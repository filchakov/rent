<?php

namespace Modules\ParserModule\Mappers;

use Carbon\Carbon;

use Modules\ParserModule\Models\ContactNullObject;
use Modules\ParserModule\Models\Lead;
use Modules\ParserModule\Models\LeadNullObject;

class SosediLunLeadMapper
{
    const ID = 'id';

    const TEXT1 = 'header1';
    const TEXT2 = 'header2';
    const TEXT3 = 'header3';

    const DONOR_ID = 'donor_id';

    const PRICE = 'price';

    const CITY_ID = 'city_id';
    const CONTACT_ID = 'contact_id';

    const DONOR_TYPE = 'donor_type';
    const CREATED_AT = 'updated_at';

    public function buildObject($leadArray){

        if(empty($leadArray)){
            return new LeadNullObject();
        } else {

            $text = implode(', ', [$leadArray[self::TEXT1], $leadArray[self::TEXT2], $leadArray[self::TEXT3], $leadArray[self::PRICE]]);
            $text .= ' <p id="imageLead"><img src="http://sosedi.lun.ua/user/img/' . $leadArray[self::ID] . '.png" /></p>';

            return new Lead(
                $leadArray[self::ID],
                $leadArray[self::DONOR_ID],
                $text,
                $leadArray[self::CITY_ID],
                $leadArray[self::CONTACT_ID],
                $leadArray[self::DONOR_TYPE],
                Carbon::createFromTimestampUTC($leadArray[self::CREATED_AT])->toDateTimeString()
            );
        }
    }
}