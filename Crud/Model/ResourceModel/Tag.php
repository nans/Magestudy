<?php

namespace Magestudy\Crud\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magestudy\Crud\Model\Tag as Model;

class Tag extends AbstractDb
{
    const MAIN_TABLE = 'crud_tag';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, Model::ID);
    }
}