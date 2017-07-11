<?php

namespace Magestudy\LogRepository\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magestudy\LogRepository\Model\Log as Model;

class Log extends AbstractDb
{
    const MAIN_TABLE = 'study_log';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, Model::ID);
    }
}