<?php

namespace Modules\ParserModule\Client;

class VkBoardsClient extends AbstractVkClient
{
    const PATH = 'method/board.getComments.json';

    protected $group_id = 0;
    protected $topic_id = 0;

    /**
     * VkWallClient constructor.
     */
    public function __construct($count, $offset, $group_id, $topic_id)
    {
        $this
            ->setGroupId($group_id)
            ->setTopicId($topic_id);
        parent::__construct($count, $offset, self::PATH);
    }

    /**
     * @return array
     */
    function getQuery()
    {
        return array_merge_recursive(parent::getQuery(), [
                'group_id' => $this->getGroupId(),
                'topic_id' => $this->getTopicId()
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
        $result = $result['comments'];
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
    public function getGroupId()
    {
        return $this->group_id;
    }

    /**
     * @param int $group_id
     * @return VkBoardsClient
     */
    public function setGroupId($group_id)
    {
        $this->group_id = $group_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getTopicId()
    {
        return $this->topic_id;
    }

    /**
     * @param int $topic_id
     * @return VkBoardsClient
     */
    public function setTopicId($topic_id)
    {
        $this->topic_id = $topic_id;
        return $this;
    }


}