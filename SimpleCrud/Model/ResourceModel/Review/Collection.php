<?php

namespace Magestudy\SimpleCrud\Model\ResourceModel\Review;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magestudy\SimpleCrud\Model\Review as Model;
use Magestudy\SimpleCrud\Model\ResourceModel\Review as ResourceModel;
use Magestudy\SimpleCrud\Api\Data\ReviewInterface;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = ReviewInterface::KEY_ID;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}