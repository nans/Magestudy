<?php

namespace Magestudy\Crud\Controller\Adminhtml\Post;

use Exception;
use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use Magento\Framework\ObjectManagerInterface;
use Magestudy\Crud\Api\PostRepositoryInterface;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\Post;
use Magestudy\Crud\Model\Factory\PostFactory;

class Edit extends Action
{
    /**
     * @var Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        ObjectManagerInterface $objectManager
    ) {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;

        parent::__construct($context);
    }

    /**
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->addBreadcrumb(__(Post::ENTITY_TITLE), __(Post::ENTITY_TITLE));
        $resultPage->addBreadcrumb(__('Manage ' . Post::ENTITY_TITLE), __('Manage ' . Post::ENTITY_TITLE));
        return $resultPage;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam(Post::ID);
        /** @var Post $model */
        /** @var PostRepositoryInterface $repository */
        $repository = $this->_objectManager->get(PostRepositoryInterface::class);

        if ($id) {
            try {
                $model = $repository->getById($id);
            } catch (Exception $exception) {
                $this->messageManager->addErrorMessage(__('This record no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        } else {
            /** @var PostFactory $factory */
            $factory = $this->_objectManager->get(PostFactory::class);
            $model = $factory->create();
        }

        $data = $this->_session->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        $this->_coreRegistry->register(strtolower(Post::ENTITY_TITLE), $model);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit ' . Post::ENTITY_TITLE) : __('New ' . Post::ENTITY_TITLE),
            $id ? __('Edit ' . Post::ENTITY_TITLE) : __('New ' . Post::ENTITY_TITLE)
        );

        $resultPage->getConfig()
            ->getTitle()
            ->prepend(
                $model->getId()
                    ? __('Edit ' . Post::ENTITY_TITLE . ': ') . $model->getTitle()
                    : __('New ' . Post::ENTITY_TITLE)
            );

        return $resultPage;
    }

    /**
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(AclResources::POST_SAVE);
    }
}