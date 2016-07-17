<?php

namespace Modules\ParserModule\Models;

use Illuminate\Contracts\Support\Arrayable;

class City implements Arrayable
{
    const ID = 'id';
    const TITLE = 'TITLE';

    protected $id = 0;
    protected $title = '';

    /**
     * City constructor.
     * @param int $id
     * @param string $title
     */
    public function __construct($id, $title)
    {
        $this
            ->setId($id)
            ->setTitle($title);
    }
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
            self::ID => $this->getId(),
            self::TITLE => $this->getTitle()
        ];
    }
}