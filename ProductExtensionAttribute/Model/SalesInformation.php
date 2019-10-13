<?php

namespace Magestudy\ProductExtensionAttribute\Model;

use Magento\Framework\Model\AbstractModel;
use Magestudy\ProductExtensionAttribute\Api\Data\SalesInformationInterface;
use Magestudy\ProductExtensionAttribute\Model\ResourceModel\SalesInformation as ResourceModel;
use Magestudy\ProductExtensionAttribute\Api\Data\SalesInformationExtensionInterface as SalesInformationExtensionInterface;

class SalesInformation extends AbstractModel implements SalesInformationInterface
{
    protected $extenstionAttributes;

    /**
     * @param SalesInformationExtensionInterface $extensionAttributes
     * @return $this|SalesInformationInterface
     */
    public function setExtensionAttributes(SalesInformationExtensionInterface $extensionAttributes)
    {
        $this->extenstionAttributes = $extensionAttributes;

        return $this;
    }

    /**
     * @return SalesInformationExtensionInterface|null
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