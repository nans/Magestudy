<?php

namespace Magestudy\Event\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class FirstEventForExample implements ObserverInterface
{
    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $time = $observer->getData('time');
        $message = 'FirstEventForExample: time from controller ' . $time;
        echo $message;
    }
}