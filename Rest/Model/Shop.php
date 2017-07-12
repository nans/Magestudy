<?php

namespace Magestudy\Rest\Model;

use Magento\Framework\App\Request\Http;
use Magento\Framework\Phrase;
use Magento\Framework\Webapi\Exception;
use Magestudy\Rest\Api\Data\PhoneInterface;
use Magestudy\Rest\Api\ShopInterface;
use Magestudy\Rest\Helper\PhoneCollection;

class Shop implements ShopInterface
{
    /**
     * @var Http
     */
    protected $_request;

    /**
     * @var PhoneCollection
     */
    protected $_phoneCollection;

    /**
     * @param Http $request
     * @param PhoneCollection $phoneCollection
     */
    public function __construct(
        Http $request,
        PhoneCollection $phoneCollection
    ) {
        $this->_request = $request;
        $this->_phoneCollection = $phoneCollection;
    }

    /**
     * @example http://magento.local/index.php/rest/V1/shop/phone/1
     * @param int $id
     * @return array
     */
    public function getPhone($id)
    {
        /** @var PhoneInterface $phone */
        $phone = $this->_phoneCollection->getById($id);
        if (!$phone) {
            $this->_throwBadRequest(__('Phone not found'), Exception::HTTP_NOT_FOUND);
        }
        return $phone->asArray();
    }

    /**
     * @example http://magento.local/index.php/rest/V1/shop/phone/
     * @return array
     */
    public function postPhone()
    {
        $id = $this->_request->getParam(Phone::ID);
        $title = $this->_request->getParam(Phone::TITLE);
        $brand = $this->_request->getParam(Phone::BRAND);
        $price = $this->_request->getParam(Phone::PRICE);
        if (!$id && (!$title || !$brand || !$price)) {
            $this->_throwBadRequest(__('Data is not correct'), Exception::HTTP_BAD_REQUEST);
        }
        if (!$id) {
            $this->_phoneCollection->addPhone($title, $brand, $price);
        } else {
            $this->_phoneCollection->updatePhone($id, $title, $brand, $price);
        }
        return $this->phones();
    }

    /**
     * @example http://magento.local/index.php/rest/V1/shop/phones
     * @return array
     */
    public function phones()
    {
        $objectsArray = $this->_phoneCollection->getAll();
        $phones = [];
        /** @var PhoneInterface $phone */
        for ($i = 0; $i < $this->_phoneCollection->length(); $i++) {
            $phone = $objectsArray[$i];
            $phones[$i] = $phone->asArray();
        }
        return $phones;
    }

    /**
     * @example http://magento.local/index.php/rest/V1/shop/buy/3800549432911/id/1
     * @param string $customerPhone
     * @param int $id
     * @return array
     */
    public function buy($customerPhone, $id)
    {
        /** @var PhoneInterface $phone */
        $phone = $this->_phoneCollection->getById($id);
        if (!$phone) {
            $this->_throwBadRequest(__('Data not found'), Exception::HTTP_NOT_FOUND);
        }
        return ['Order id' => rand(1000, 10000)];
    }

    /**
     * @param string $message
     * @param int $code
     * @throws Exception
     */
    protected function _throwBadRequest($message, $code)
    {
        throw new Exception(new Phrase($message), 0, $code);
    }
}