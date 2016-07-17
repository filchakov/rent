<?php

namespace Modules\ParserModule;

use App\Lead;
use App\LunDonor;
use Modules\ParserModule\Client\SosediLunClient;
use Modules\ParserModule\Mappers\SosediLunLeadMapper;

class SosediLunService
{

    protected $sosediClient = null;

    /**
     * SosediLunService constructor.
     */
    public function __construct()
    {
        $this->sosediClient = new SosediLunClient('', 0);
    }


    public function getNewLead()
    {
        $timestart = time();

        $sosedi = $this->getSosedi();

        return [
            'sosedi' => $sosedi,
            'total_time' => (time() - $timestart)
        ];
    }

    /**
     * @return SosediLunClient
     */
    public function getSosediClient()
    {
        return $this->sosediClient;
    }

    /**
     * @param null $sosediClient
     * @return $this
     */
    public function setSosediClient($sosediClient)
    {
        $this->sosediClient = $sosediClient;
        return $this;
    }

    private function getSosedi()
    {
        $sosediDonors = LunDonor::getSosedi();

        $total_row = 0;

        foreach($sosediDonors as $key => $orderBoards){
            sleep(1);

            $this->getSosediClient()
                ->setCity($orderBoards->query)
                ->setLastUpdate($orderBoards->last_offer_id);

            $resultLeads = $this->getSosediClient()->getLeads();

            $resultLeads = $resultLeads->sortByDesc('updated_at')->filter(
                function ($value, $key) use ($orderBoards) {
                    return $value['updated_at'] > $orderBoards['last_update'];
                }
            )->toArray();

            $this->saveLeads($orderBoards, $resultLeads);

            if(empty($resultLeads)){
                return $total_row;
            }

            $orderBoards->last_update = $resultLeads[0]['updated_at'];
            $orderBoards->save();

            $total_row += count($resultLeads);
        }


        return $total_row;

    }

    /**
     * @param $order
     * @param array $getLeads
     * @return bool
     */
    private function saveLeads($order, $getLeads = [])
    {

        foreach($getLeads as $lead){
            $lead['donor_id'] = $order->id;
            $lead['donor_type'] = 'sosedi_lun';
            $lead['city_id'] = $order->city_id;
            $lead['contact_id'] = $this->getOrCreateContact($lead);

            Lead::create($this->getLeadMapper()->buildObject($lead)->toArray());

            $this->saveImage($lead);
        }

        return true;
    }

    /**
     * @param $lead
     * @return int
     */
    private function getOrCreateContact($lead)
    {
        return 0;
    }

    /**
     * @param $leadArray
     * @return int
     */
    protected function saveImage($leadArray){
        $data = file_get_contents('http://sosedi.lun.ua/user/img/' . $leadArray['id'] . '.png');
        $new = public_path() . '/assets/images/lun/'.$leadArray['id'] . '.png';
        return file_put_contents($new, $data);
    }

    /**
     * @return SosediLunLeadMapper
     */
    protected function getLeadMapper()
    {
        return new SosediLunLeadMapper();
    }


}