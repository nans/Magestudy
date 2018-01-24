<?php

namespace Magestudy\Customjs\Controller\Test;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Simple extends Action
{
    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;

    /**
     * Constructor
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Execute view action
     * @url domain/customjs/test/simple
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        return $this->_resultPageFactory->create();
    }
}