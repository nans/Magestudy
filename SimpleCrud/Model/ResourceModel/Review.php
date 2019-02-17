<?php

namespace Magestudy\SimpleCrud\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magestudy\SimpleCrud\Api\Data\ReviewInterface;

class Review extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('simple_crud_review', ReviewInterface::KEY_ID);
    }
}