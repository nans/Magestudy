<?php

namespace Magestudy\PluginExample\Plugin\Customer\Model;

use Magento\Customer\Model\AccountManagement;
use Magento\Customer\Model\Data\Customer;
use Magento\Framework\Message\ManagerInterface;

class AccountManagementPlugin
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

    public function beforeAuthenticate(AccountManagement $subject, $username, $password)
    {
        $this->messageManager->addErrorMessage('This text added before customer authenticate.');
        return [$username, $password];
    }

    public function afterCreateAccountWithPasswordHash(AccountManagement $subject, Customer $result)
    {
        $this->messageManager->addErrorMessage('This text added after customer create account.');
        return $result;
    }
}