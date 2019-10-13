<?php

namespace Magestudy\ProductExtensionAttribute\Api\Data;

use Magestudy\ProductExtensionAttribute\Api\Data\SalesInformationExtensionInterface as SalesInformationExtensionInterface;
use Magento\Framework\Api\ExtensibleDataInterface;

interface SalesInformationInterface extends ExtensibleDataInterface
{
    const KEY_ID           = 'id';
    const KEY_PRODUCT_ID   = 'product_id';
    const KEY_ORDER_STATUS = 'order_status';
    const KEY_QTY          = 'qty';
    const KEY_UPDATED_AT   = 'updated_at';

    /**
     * @return SalesInformationExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * @param SalesInformationExtensionInterface $extensionAttributes
     * @return self
     */
    public function setExtensionAttributes(SalesInformationExtensionInterface $extensionAttributes);
}