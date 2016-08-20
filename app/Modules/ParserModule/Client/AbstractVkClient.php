<?php

namespace Modules\ParserModule\Client;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Modules\ParserModule\Contract\IProvider;
use Modules\ParserModule\Models\Lead;
use Log;

abstract class AbstractVkClient implements IProvider
{
    const BASE_URL = 'https://api.vk.com';
    const LANG = 'ru';

    protected $path = '';
    protected $count = 10;
    protected $offset = 0;

    protected $client = null;

    /**
     * AbstractVkClient constructor.
     * @param int $count
     * @param int $offset
     * @param string $path
     */
    public function __construct($count, $offset = 0, $path)
    {
        $this
            ->setCount($count)
            ->setOffset($offset)
            ->setPath($path);

        $this->setClient();
    }

    /**
     * @return array
     */
    function getQuery(){
        return [
            'count' => $this->getCount(),
            'offset' => $this->getOffset(),
            'lang' => self::LANG,
            'access_token' => '6954323cae6ec55d5e91a7d162507f5b200a0c1d24701d13b1d14ae4b0f98421d0aecf46aace2f2082235'
        ];
    }

    abstract function getLeads($offset);

    abstract function getLead($id);

    /**
     * @return array
     */
    function sendRequest(){
        $result = $this->getClient()->get($this->getPath(), [
            'query' => $this->getQuery()
        ])->getBody()->getContents();

        try{
            $result = json_decode($result, 1)['response'];
        } catch (\Exception $e){

            Log::warning('#VK,' . $result);

            $result = [];
        }

        return $result;
    }

    /**
     * @param Lead $lead
     * @return mixed
     */
    public function pushLead(Lead $lead){
        return $this->leadsCollection->pull($lead->getDonorFeedid(), $lead);
    }


    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param int $count
     * @return $this
     */
    public function setCount($count)
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     * @return $this
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return $this
     * @internal param null $client
     */
    public function setClient()
    {
        $this->client = new Client([
            'base_uri'        => self::BASE_URL
        ]);
        return $this;
    }

}