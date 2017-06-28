<?php

namespace Magestudy\CronExample\Cron;

use Psr\Log\LoggerInterface;

class SampleTask
{
    /**
     * @var LoggerInterface
     */
    protected $_logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger
    ) {
        $this->_logger = $logger;
    }

    public function execute()
    {
        $this->_logger->debug('Cron task was started at ' . date('Y-m-d h:i:s'));
    }
}