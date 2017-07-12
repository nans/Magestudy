<?php

namespace Magestudy\Crud\Controller\Adminhtml\Category;

use Exception;
use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use Magento\Framework\ObjectManagerInterface;
use Magestudy\Crud\Api\CategoryRepositoryInterface;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\Category;
use Magestudy\Crud\Model\Factory\CategoryFactory;

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
        $resultPage->addBreadcrumb(__(Category::ENTITY_TITLE), __(Category::ENTITY_TITLE));
        $resultPage->addBreadcrumb(__('Manage ' . Category::ENTITY_TITLE), __('Manage ' . Category::ENTITY_TITLE));
        return $resultPage;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam(Category::ID);
        /** @var Category $model */
        /** @var CategoryRepositoryInterface $repository */
        $repository = $this->_objectManager->get(CategoryRepositoryInterface::class);

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
            /** @var CategoryFactory $factory */
            $factory = $this->_objectManager->get(CategoryFactory::class);
            $model = $factory->create();
        }

        $data = $this->_session->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        $this->_coreRegistry->register(strtolower(Category::ENTITY_TITLE), $model);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit ' . Category::ENTITY_TITLE) : __('New ' . Category::ENTITY_TITLE),
            $id ? __('Edit ' . Category::ENTITY_TITLE) : __('New ' . Category::ENTITY_TITLE)
        );

        $resultPage->getConfig()
            ->getTitle()
            ->prepend(
                $model->getId()
                    ? __('Edit ' . Category::ENTITY_TITLE . ': ') . $model->getTitle()
                    : __('New ' . Category::ENTITY_TITLE)
            );

        return $resultPage;
    }

    /**
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(AclResources::CATEGORY_SAVE);
    }
}