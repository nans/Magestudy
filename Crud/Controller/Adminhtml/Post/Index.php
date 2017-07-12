<?php

namespace Magestudy\Crud\Controller\Adminhtml\Post;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magestudy\Crud\Helper\AclResources;
use Magento\Backend\App\Action;
use Magestudy\Crud\Model\Post;

class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->addBreadcrumb(__(Post::ENTITY_TITLE), __(Post::ENTITY_TITLE));
        $resultPage->addBreadcrumb(__('Manage ' . Post::ENTITY_TITLE), __('Manage ' . Post::ENTITY_TITLE));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage ' . Post::ENTITY_TITLE));

        return $resultPage;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(AclResources::POST);
    }
}