<?php

namespace Magestudy\PluginExample\Plugin\Customer\Model;

use Magento\Customer\Model\AccountManagement;
use Magento\Framework\Message\ManagerInterface;

class SecondAccountManagementPlugin
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
        $this->messageManager->addSuccessMessage('Second Plugin: This text added before customer authenticate.');
        return [$username, $password];
    }

    public function afterAuthenticate(AccountManagement $subject, $result)
    {
        $this->messageManager->addSuccessMessage('Second Plugin: This text added after customer authenticate.');

        return $result;
    }

    public function aroundAuthenticate(AccountManagement $subject, callable $proceed, $username, $password)
    {
        $this->messageManager->addSuccessMessage('Second Plugin: This text added before proceed');

        $result = $proceed($username, $password);

        $this->messageManager->addSuccessMessage('Second Plugin: This text added after proceed');

        return $result;
    }
}