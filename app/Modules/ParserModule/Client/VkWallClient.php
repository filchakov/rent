<?php

namespace Modules\ParserModule\Client;

class VkWallClient extends AbstractVkClient
{
    const PATH = 'method/wall.get.json';

    protected $owner_id = 0;

    /**
     * VkWallClient constructor.
     */
    public function __construct($count, $offset, $owner_id)
    {
        $this->setOwnerId($owner_id);
        parent::__construct($count, $offset, self::PATH);
    }

    function getQuery()
    {
        return array_merge_recursive(parent::getQuery(), [
            'owner_id' => $this->getOwnerId()
        ]);
    }

    /**
     * @param $offset
     * @return array
     */
    function getLeads($offset)
    {
        $this->setOffset($offset);
        $result = $this->sendRequest();

        unset($result[0]);
        return $result;
    }

    function getLead($id)
    {
        // TODO: Implement getLead() method.
    }

    /**
     * @return int
     */
    public function getOwnerId()
    {
        return $this->owner_id;
    }

    /**
     * @param int $owner_id
     * @return $this
     */
    public function setOwnerId($owner_id)
    {
        $this->owner_id = $owner_id;
        return $this;
    }


}