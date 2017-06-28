<?php

namespace Magestudy\LogRepository\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magestudy\LogRepository\Model\Log as Model;

class Log extends AbstractDb
{
    const MAIN_TABLE = 'study_log';

    /**
     * Construct
     *
     * @param Context $context
     * @param string|null $resourcePrefix
     */
    public function __construct(
        Context $context,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
    }

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