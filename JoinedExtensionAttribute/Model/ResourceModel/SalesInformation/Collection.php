<?php

namespace Magestudy\JoinedExtensionAttribute\Model\ResourceModel\SalesInformation;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magestudy\JoinedExtensionAttribute\Model\SalesInformation as Model;
use Magestudy\JoinedExtensionAttribute\Model\ResourceModel\SalesInformation as ResourceModel;
use Magestudy\JoinedExtensionAttribute\Api\Data\SalesInformationInterface;

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