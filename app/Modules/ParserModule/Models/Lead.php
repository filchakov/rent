<?php

namespace Modules\ParserModule\Models;

use Illuminate\Contracts\Support\Arrayable;

class Lead implements Arrayable
{
    const DONOR_FEED_ID = 'donor_feed_id';
    const TEXT = 'text';
    const CITY = 'city_id';
    const DONOR_ID = 'donor_id';
    const DONOR_CREATED_AT = 'donor_created_at';
    const DONOR_TYPE = 'donor_type';

    /**
     * @var int
     */
    protected $donor_feed_id = 0;

    /**
     * @var int
     */
    protected $donor_id = 0;

    /**
     * @var string
     */
    protected $text = '';

    /**
     * @var int
     */
    protected $cityId = 0;

    /**
     * @var int
     */
    protected $contactId = 0;

    /**
     * @var int
     */
    protected $donor_created_at = 0;

    /**
     * @var string
     */
    protected $donor_type = '';

    /**
     * Lead constructor.
     * @param $donor_feed_id
     * @param $donor_id
     * @param $text
     * @param int $cityId
     * @param int $contactId
     * @param $createdAt
     */
    public function __construct($donor_feed_id, $donor_id, $text, $cityId, $contactId, $donor_type, $createdAt)
    {
        $this
            ->setDonorFeedid($donor_feed_id)
            ->setDonorId($donor_id)
            ->setText($text)
            ->setCityId($cityId)
            ->setContactId($contactId)
            ->setDonorType($donor_type)
            ->setDonorCreatedAt($createdAt);
    }

    /**
     * @return int
     */
    public function getDonorFeedid()
    {
        return $this->donor_feed_id;
    }

    /**
     * @param int $donor_feed_id
     * @return $this
     */
    public function setDonorFeedid($donor_feed_id)
    {
        $this->donor_feed_id = $donor_feed_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getDonorId()
    {
        return $this->donor_id;
    }

    /**
     * @param int $donor_id
     * @return Lead
     */
    public function setDonorId($donor_id)
    {
        $this->donor_id = $donor_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return int
     */
    public function getCityId()
    {
        return $this->cityId;
    }

    /**
     * @param int $cityId
     * @return $this
     */
    public function setCityId($cityId)
    {
        $this->cityId = $cityId;
        return $this;
    }

    /**
     * @return int
     */
    public function getContactId()
    {
        return $this->contactId;
    }

    /**
     * @param int $contactId
     * @return $this
     */
    public function setContactId($contactId)
    {
        $this->contactId = $contactId;
        return $this;
    }

    /**
     * @return int
     */
    public function getDonorCreatedAt()
    {
        return $this->donor_created_at;
    }

    /**
     * @param int $donor_created_at
     * @return $this
     */
    public function setDonorCreatedAt($donor_created_at)
    {
        $this->donor_created_at = $donor_created_at;
        return $this;
    }

    /**
     * @return string
     */
    public function getDonorType()
    {
        return $this->donor_type;
    }

    /**
     * @param string $donor_type
     * @return $this
     */
    public function setDonorType($donor_type)
    {
        $this->donor_type = $donor_type;
        return $this;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            self::DONOR_FEED_ID => $this->getDonorFeedid(),
            self::DONOR_ID => $this->getDonorId(),
            self::TEXT => $this->getText(),
            self::CITY => $this->getCityId(),
            self::DONOR_TYPE => $this->getDonorType(),
            self::DONOR_CREATED_AT => $this->getDonorCreatedAt()
        ];
    }
}