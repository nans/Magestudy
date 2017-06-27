<?php

namespace Magestudy\Controller\Controller\Hello;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\ForwardFactory;

class World extends Action
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
        //index.php/controller/hello/world
        echo 'Hello controller; World action;';
        die;
    }
}