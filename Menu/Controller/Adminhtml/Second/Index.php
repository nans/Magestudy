<?php

namespace Magestudy\Menu\Controller\Adminhtml\Second;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface|null
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->addBreadcrumb('Second Manager', 'Second Manager');
        $resultPage->getConfig()->getTitle()->prepend(__('Second'));
        return $resultPage;
    }

    /**
     * Check current user permission on resource and privilege
     * @return  boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magestudy_Menu::second_index');
    }
}
