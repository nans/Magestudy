<?php

namespace Magestudy\ProductExtensionAttribute\Model\ResourceModel\SalesInformation;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magestudy\ProductExtensionAttribute\Model\SalesInformation as Model;
use Magestudy\ProductExtensionAttribute\Model\ResourceModel\SalesInformation as ResourceModel;
use Magestudy\ProductExtensionAttribute\Api\Data\SalesInformationInterface;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = SalesInformationInterface::KEY_ID;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}