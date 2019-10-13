<?php

namespace Magestudy\ProductExtensionAttribute\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Magestudy\ProductExtensionAttribute\Api\Data\SalesInformationInterface;
use Magestudy\ProductExtensionAttribute\Model\ResourceModel\SalesInformation as ResourceModel;

class SalesInformation extends AbstractExtensibleModel implements SalesInformationInterface
{
    /**
     * {@inheritdoc}
     * @return \Magestudy\ProductExtensionAttribute\Api\Data\SalesInformationExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * {@inheritdoc}
     * @param \Magestudy\ProductExtensionAttribute\Api\Data\SalesInformationExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Magestudy\ProductExtensionAttribute\Api\Data\SalesInformationExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
        parent::_construct();
    }
}