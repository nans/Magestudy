<?php

namespace Magestudy\Crud\Model\ResourceModel\PostTag;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magestudy\Crud\Model\PostTag as Model;
use Magestudy\Crud\Model\ResourceModel\PostTag as ResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            Model::class,
            ResourceModel::class
        );
    }
}