<?php

namespace Modules\ParserModule;


use App\Donor;
use App\Lead;
use Modules\ParserModule\Client\VkBoardsClient;
use Modules\ParserModule\Client\VkWallClient;
use Modules\ParserModule\Mappers\LeadMapper;

class VkService
{

    const LIMIT = 100;

    protected $wallsClient = null;
    protected $boardsClient = null;


    /**
     * VkService constructor.
     */
    public function __construct()
    {
        $this
            ->setWallsClient(new VkWallClient(self::LIMIT, 0, 0))
            ->setBoardsClient(new VkBoardsClient(self::LIMIT, 0, 0, 0));
    }


    public function getNewLead(){

        $timestart = time();

        $boards = $this->getBoards();
        $walls = $this->getWalls();

        return [
            'wall' => $walls,
            'boards' => $boards,
            'total_time' => (time() - $timestart)
        ];
    }


    public function getBoards()
    {
        $boardsDonors = Donor::getBoardsVk();

        $total_row = 0;

        foreach($boardsDonors as $key => $orderBoards){
            sleep(1);

            $this->getBoardsClient()->setGroupId($orderBoards->feed_id)->setTopicId($orderBoards->sub_feed_id);

            $resultLeads = $this->getBoardsClient()->getLeads($orderBoards->offset);

            $this->saveLeads($orderBoards, $resultLeads);

            $orderBoards->offset += count($resultLeads);
            $orderBoards->save();

            $total_row += count($resultLeads);
        }


        return $total_row;
    }

    public function getWalls(){

        $wallsDonors = Donor::getWallsVk();

        $total_row = 0;

        foreach($wallsDonors as $key => $orderWall){
            sleep(1);

            $this->getWallsClient()->setOwnerId('-'.$orderWall->feed_id);

            $resultLeads = $this->getWallsClient()->getLeads($orderWall->offset);

            $this->saveLeads($orderWall, $resultLeads);

            $orderWall->offset += count($resultLeads);
            $orderWall->save();

            $total_row += count($resultLeads);
        }
        return $total_row;
    }

    /**
     * @return VkWallClient
     */
    protected function getWallsClient()
    {
        return $this->wallsClient;
    }

    /**
     * @param null $wallsClient
     * @return $this
     */
    protected function setWallsClient($wallsClient)
    {
        $this->wallsClient = $wallsClient;
        return $this;
    }

    /**
     * @return VkBoardsClient
     */
    protected function getBoardsClient()
    {
        return $this->boardsClient;
    }

    /**
     * @return LeadMapper
     */
    public function getLeadMapper()
    {
        return new LeadMapper();
    }

    /**
     * @param null $boardsClient
     * @return $this
     */
    protected function setBoardsClient($boardsClient)
    {
        $this->boardsClient = $boardsClient;
        return $this;
    }

    private function saveLeads($order, $getLeads = [])
    {

        foreach($getLeads as $lead){
            $lead['donor_id'] = $order->id;
            $lead['donor_type'] = $order->type . '_vk';
            $lead['city_id'] = $order->city_id;
            $lead['contact_id'] = $this->getOrCreateContact($lead);

            Lead::create($this->getLeadMapper()->buildObject($lead)->toArray());
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

}