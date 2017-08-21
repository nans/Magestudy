<?php

namespace Magestudy\Crud\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magestudy\Crud\Model\Post as Model;
use Magestudy\Crud\Model\ResourceModel\Post as ResourceModel;

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