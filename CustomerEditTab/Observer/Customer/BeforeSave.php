<?php

namespace Magestudy\CustomerEditTab\Observer\Customer;

use Magento\Framework\App\Request\Http;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Message\ManagerInterface;
use Magestudy\CustomerEditTab\Block\Adminhtml\Edit\Tab\ExampleForm;

class BeforeSave implements ObserverInterface
{
    /**
     * @var Http
     */
    private $http;
    /**
     * @var ManagerInterface
     */
    private $messageManager;

    /**
     * @param Http $http
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        Http $http,
        ManagerInterface $messageManager
    ) {
        $this->http = $http;
        $this->messageManager = $messageManager;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $params = $this->http->getParams();
        if (!key_exists(ExampleForm::FORM_PREFIX, $params)
            || !is_array($params[ExampleForm::FORM_PREFIX])
            || count($params[ExampleForm::FORM_PREFIX]) == 0
        ) {
            return;
        }

        $exampleTabData = $params[ExampleForm::FORM_PREFIX];
        $this->messageManager->addNoticeMessage('Data from example tab ' . \Zend_Json_Encoder::encode($exampleTabData));
    }
}