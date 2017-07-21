<?php

namespace Magestudy\Event\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class SecondEventForExample implements ObserverInterface
{
    /**
     * @var LoggerInterface
     */
  /*  protected $_logger;

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->_logger = $logger;
    }*/

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $dateTime = $observer->getData('date_time');
        $message = 'SecondEventForExample: dateTime from controller ' . $dateTime;
        echo $message;
    }
}