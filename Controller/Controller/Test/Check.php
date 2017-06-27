<?php

namespace Magestudy\Controller\Controller\Test;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\ForwardFactory;

class Check extends Action
{
    /** @var ForwardFactory */
    protected $_resultForwardFactory;

    /**
     * @param Context $context ,
     * @param ForwardFactory $resultForwardFactory
     */
    public function __construct(
        Context $context,
        ForwardFactory $resultForwardFactory
    ) {
        $this->_resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        //index.php/controller/test/check
        echo 'Test controller; Check action;';
        die;
    }
}