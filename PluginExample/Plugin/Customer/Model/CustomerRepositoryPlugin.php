<?php

namespace Magestudy\PluginExample\Plugin\Customer\Model;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\Message\ManagerInterface;

class CustomerRepositoryPlugin
{
    /** @var ManagerInterface */
    private $messageManager;

    /**
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        ManagerInterface $messageManager
    ) {
        $this->messageManager = $messageManager;
    }

    public function aroundSave(
        CustomerRepositoryInterface $subject,
        callable $proceed,
        CustomerInterface $customer,
        $passwordHash = null
    ) {
        $this->messageManager->addNoticeMessage('Message before save customer');
        $savedCustomer = $proceed($customer, $passwordHash);
        $this->messageManager->addNoticeMessage('Message after save customer');
        return $savedCustomer;
    }
}