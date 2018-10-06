<?php

namespace Magestudy\LoggerExample\Helper;

use Magestudy\LoggerExample\Logger\Logger;
use Magento\Framework\App\Helper\Context;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @param Context $context
     * @param Logger $logger
     */
    public function __construct(
        Context $context,
        Logger $logger
    ) {
        parent::__construct($context);
        $this->logger = $logger;
    }

    public function sampleForUse()
    {
        $this->logger->addCritical('First test');
        $this->logger->addNotice('Second test');
    }
}