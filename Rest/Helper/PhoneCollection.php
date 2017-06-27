<?php

namespace Magestudy\Rest\Helper;

use Magento\Framework\ObjectManagerInterface;
use Magestudy\Rest\Api\Data\PhoneInterface;

class PhoneCollection
{
    /**
     * @var ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * @var array
     */
    protected $_phonesList;

    /**
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(
        ObjectManagerInterface $objectManager
    ) {
        $this->_objectManager = $objectManager;

        $this->_phonesList = [];
        $this->addPhone('BestPhone', 1, 1000);
        $this->addPhone('SimplePhone', 2, 200);
        $this->addPhone('BasicPhone', 3, 500);
    }

    /**
     * @param int $id
     * @return PhoneInterface|null
     */
    public function getById($id)
    {
        /** @var PhoneInterface $phone */
        for ($i = 0; $i < $this->length(); $i++) {
            $phone = $this->_phonesList[$i];
            if ($phone->getId() == $id) {
                return $phone;
            }
        }
        return null;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->_phonesList;
    }

    /**
     * @return int
     */
    public function length()
    {
        return count($this->_phonesList);
    }

    /**
     * @param string $title
     * @param int $brandId
     * @param float $price
     */
    public function addPhone($title = null, $brandId = null, $price = null)
    {
        $this->_addPhoneToList($this->_createPhone($this->length() + 1, $title, $brandId, $price));
    }

    /**
     * @param int $id
     * @param string $title
     * @param int $brand
     * @param float $price
     */
    public function updatePhone($id, $title, $brand, $price)
    {
        $phone = $this->getById($id);
        if ($title) {
            $phone->setTitle($title);
        }
        if ($brand) {
            $phone->setBrandId($brand);
        }
        if ($price) {
            $phone->setPrice($price);
        }
    }

    /**
     * @param int $id
     * @param string $title
     * @param int $brandId
     * @param float $price
     * @return PhoneInterface
     */
    private function _createPhone($id, $title, $brandId, $price)
    {
        /** @var PhoneInterface $phone */
        $phone = $this->_objectManager->create(PhoneInterface::class);
        $phone->setId($id);
        $phone->setTitle($title);
        $phone->setBrandId($brandId);
        $phone->setPrice($price);
        return $phone;
    }

    /**
     * @param PhoneInterface $phone
     */
    private function _addPhoneToList(PhoneInterface $phone)
    {
        $this->_phonesList[$this->length()] = $phone;
    }
}