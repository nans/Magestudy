<?php

namespace Magestudy\Crud\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magestudy\Crud\Model\Category as Model;

class Category extends AbstractDb
{
    /**
     * @return string
     */
    public static function getTableName()
    {
        return 'crud_category';
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::getTableName(), Model::ID);
    }
}