<?php

namespace Modules\ParserModule\Client;

use Exception;
use GuzzleHttp\Client;
use Modules\ParserModule\Contract\IProvider;

class SosediLunClient implements IProvider
{

    const BASE_URL = 'http://sosedi.lun.ua';

    const PATH = 'ajaxlist';

    const OFFSET = 10;

    protected $path = '';
    protected $city = '';
    protected $offset = 0;

    protected $last_update = 0;

    protected $client = null;

    /**
     * SosediLunClient constructor.
     * @param $city
     */
    public function __construct($city)
    {
        $this
            ->setPath(self::PATH)
            ->setCity($city);

        $this->setClient();
    }

    /**
     * @return array
     */
    public function getQuery()
    {
        return [
            'query' => $this->getCity(),
            'offset' => $this->getOffset()
        ];
    }

    public function getLeads($offset = null)
    {
        if(!empty($offset)){
            $this->setOffset($this->getOffset() + $offset);
        }

        $result = collect($this->sendRequest());

        if((empty($result[0]) || (!empty($result[0]) && $result[0]['id'] >= $this->getLastUpdate())) && $this->getOffset() <= 100){
            foreach ($this->getLeads(self::OFFSET) as $tmpOffer){
                $result->push($tmpOffer);
            }
        }

        return $result;
    }

    public function getLead($id)
    {
        // TODO: Implement getLead() method.
    }

    public function sendRequest()
    {
        try {
            $result = $this->getClient()->get($this->getPath(), [
                'query' => $this->getQuery(),
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36',
                    'Accept'     => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                    'Accept-Encoding'      => 'gzip, deflate, sdch',
                    'Cache-Control' => 'no-cache',
                    'Cookie' => '_sosedi_identity=80032aa54add45305c5a08d5303f68fc0b56f879da334eaf6d67b294fbe92c70a%3A2%3A%7Bi%3A0%3Bs%3A16%3A%22_sosedi_identity%22%3Bi%3A1%3Bs%3A51%3A%22%5B103748%2C%22EM2Mbsv3NewcMy9yXYtuCfB7Gp68gnSO%22%2C2592000%5D%22%3B%7D'
                ]
            ]);
            $result = $result->getBody()->getContents();
            $result = json_decode($result, 1)['data'];
        } catch (\Exception $e){
            $result = [];
        } finally {
            return $result;
        }
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
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
     * @return int
     */
    public function getLastUpdate()
    {
        return $this->last_update;
    }

    /**
     * @param int $last_update
     * @return $this
     */
    public function setLastUpdate($last_update)
    {
        $this->last_update = $last_update;
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
     * @param null $client
     * @return $this
     */
    public function setClient()
    {
        $this->client = new Client([
            'base_uri'        => self::BASE_URL
        ]);
        return $this;
    }


}