<?php

namespace Magestudy\CustomerAccountTab\Controller\Example;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Config\Model\ResourceModel\Config;

/**
 * Code in this class is not good, because it is very simple and don't use best practise
 */
class Post extends Action
{
    /**
     * @var Config
     */
    private $config;

    public function __construct(
        Context $context,
        Config $config
    ) {
        parent::__construct($context);
        $this->config = $config;
    }

    public function execute()
    {
        $fieldValue = trim($this->getRequest()->getParam('example_field'));
        if (!$fieldValue) {
            $this->_redirect('custom/example/index');
            return;
        }

        $this->config->saveConfig(
            'custom/example/value',
            $fieldValue,
            'default',
            0
        );

        $this->messageManager->addSuccessMessage(__('Changes saved!'));

        $this->_redirect('custom/example/index');
    }
}