<?php

namespace Magestudy\ProductExtensionAttribute\Model;

use Magento\ExternalLinks\Api\Data\ExternalLinkExtensionInterface;
use Magento\Framework\Model\AbstractModel;
use Magestudy\ProductExtensionAttribute\Api\Data\SalesInformationInterface;
use Magestudy\ProductExtensionAttribute\Model\ResourceModel\SalesInformation as ResourceModel;

class SalesInformation extends AbstractModel implements SalesInformationInterface
{
    protected $extenstionAttributes;

    /**
     * @return int
     */
    public function getQty()
    {
        return $this->getData(self::KEY_QTY);
    }

    /**
     * @return string
     */
    public function getLastOrder()
    {
        return $this->getData(self::KEY_UPDATED_AT);
    }

    /**
     * @param ExternalLinkExtensionInterface $extensionAttributes
     * @return $this|SalesInformationInterface
     */
    public function setExtensionAttributes(ExternalLinkExtensionInterface $extensionAttributes)
    {
        $this->extenstionAttributes = $extensionAttributes;

        return $this;
    }

    /**
     * @return ExternalLinkExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->extenstionAttributes;
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}