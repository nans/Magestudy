<?php

namespace Magestudy\Rest\Model;

use Magestudy\Rest\Api\Data\PhoneInterface;

class Phone implements PhoneInterface
{
    const ID = 'id';
    const PRICE = 'price';
    const BRAND = 'brand';
    const TITLE = 'title';

    /**
     * @var int
     */
    protected $_id;

    /**
     * @var string
     */
    protected $_title;

    /**
     * @var int
     */
    protected $_brandId;

    /**
     * @var float
     */
    protected $_price;


    /**
     * @return string
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    }

    /**
     * @return int
     */
    public function getBrandId()
    {
        return $this->_brandId;
    }

    /**
     * @param int $brandId
     */
    public function setBrandId($brandId)
    {
        $this->_brandId = $brandId;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->_price = $price;
    }

    /**
     * @return array
     */
    public function asArray()
    {
        return [
            self::ID => $this->getId(),
            self::PRICE => $this->getPrice(),
            self::BRAND => $this->getBrandId(),
            self::TITLE => $this->getTitle()
        ];
    }
}