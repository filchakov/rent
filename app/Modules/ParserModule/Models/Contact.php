<?php

namespace Modules\ParserModule\Models;

use Illuminate\Contracts\Support\Arrayable;

class Contact implements Arrayable
{
    const ID = 'id';
    const LINK_OFFER = 'linkOffer';
    const PHONE = 'phone';
    const FACEBOOK_PROFILE = 'facebookProfile';
    const VK_PROFILE = 'vkProfile';

    const CITY = 'city';
    const BIRTHDAY = 'birthday';
    const GENDER = 'gender';
    const AVATAR = 'avatar';

    /**
     * @var int
     */
    protected $id = 0;

    /**
     * @var string
     */
    protected $linkOffer = '';

    /**
     * @var string
     */
    protected $phone = '';

    /**
     * @var string
     */
    protected $facebookProfile = '';

    /**
     * @var string
     */
    protected $vkProfile = '';

    /**
     * @var City
     */
    protected $city = null;

    /**
     * @var int
     */
    protected $birthday = 0;

    /**
     * @var int
     */
    protected $gender = 0;

    /**
     * @var string
     */
    protected $avatar = '';

    /**
     * Contact constructor.
     * @param $id
     * @param $linkOffer
     * @param $phone
     * @param $facebookProfile
     * @param $vkProfile
     * @param $city
     * @param $birthday
     * @param $gender
     * @param $avatar
     */
    public function __construct($id, $linkOffer, $phone, $facebookProfile, $vkProfile, City $city, $birthday, $gender, $avatar)
    {
        $this
            ->setId($id)
            ->setLinkOffer($linkOffer)
            ->setPhone($phone)
            ->setFacebookProfile($facebookProfile)
            ->setVkProfile($vkProfile)
            ->setCity($city)
            ->setBirthday($birthday)
            ->setGender($gender)
            ->setAvatar($avatar);
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
    public function getLinkOffer()
    {
        return $this->linkOffer;
    }

    /**
     * @param string $linkOffer
     * @return $this
     */
    public function setLinkOffer($linkOffer)
    {
        $this->linkOffer = $linkOffer;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getFacebookProfile()
    {
        return $this->facebookProfile;
    }

    /**
     * @param string $facebookProfile
     * @return $this
     */
    public function setFacebookProfile($facebookProfile)
    {
        $this->facebookProfile = $facebookProfile;
        return $this;
    }

    /**
     * @return string
     */
    public function getVkProfile()
    {
        return $this->vkProfile;
    }

    /**
     * @param string $vkProfile
     * @return $this
     */
    public function setVkProfile($vkProfile)
    {
        $this->vkProfile = $vkProfile;
        return $this;
    }

    /**
     * @return City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param City $city
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return int
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param int $birthday
     * @return $this
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * @return int
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param int $gender
     * @return $this
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     * @return $this
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
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
            self::LINK_OFFER => $this->getLinkOffer(),
            self::PHONE => $this->getPhone(),
            self::FACEBOOK_PROFILE => $this->getFacebookProfile(),
            self::VK_PROFILE => $this->getVkProfile(),
            self::CITY => $this->getCity(),
            self::BIRTHDAY => $this->getBirthday(),
            self::GENDER => $this->getGender(),
            self::AVATAR => $this->getAvatar()
        ];
    }
}