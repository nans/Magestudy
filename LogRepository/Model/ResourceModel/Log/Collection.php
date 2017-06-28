<?php

namespace Magestudy\LogRepository\Model\ResourceModel\Log;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magestudy\LogRepository\Model\Log as Model;
use Magestudy\LogRepository\Model\ResourceModel\Log as ResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = Model::ID;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}