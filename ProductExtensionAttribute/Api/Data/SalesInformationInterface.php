<?php

namespace Magestudy\ProductExtensionAttribute\Api\Data;

use Magento\ExternalLinks\Api\Data\ExternalLinkExtensionInterface;
use Magento\Framework\Api\ExtensibleDataInterface;

interface SalesInformationInterface extends ExtensibleDataInterface
{
    const KEY_ID           = 'id';
    const KEY_PRODUCT_ID   = 'product_id';
    const KEY_ORDER_STATUS = 'order_status';
    const KEY_QTY          = 'qty';
    const KEY_UPDATED_AT   = 'updated_at';

    /**
     * @return int
     */
    public function getQty();

    /**
     * @return string
     */
    public function getLastOrder();

    /**
     * @return ExternalLinkExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * @param ExternalLinkExtensionInterface $extensionAttributes
     * @return self
     */
    public function setExtensionAttributes(ExternalLinkExtensionInterface $extensionAttributes);
}