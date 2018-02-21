<?php

namespace Magestudy\Crud\Controller\Adminhtml;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use Magento\Framework\ObjectManagerInterface;
use Magestudy\Crud\Api\FactoryInterface;
use Magestudy\Crud\Api\RepositoryInterface;
use Magestudy\Crud\Helper\Data;
use Magento\Framework\Model\AbstractModel;

abstract class AbstractEdit extends AbstractAction
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
     * @param PageFactory $resultPageFactory
     * @param Registry $registry
     * @param ObjectManagerInterface $objectManager
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
     * @return Page|Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam(Data::FRONTEND_ID);

        /** @var AbstractModel $model */
        if ($id) {
            try {
                $model = $this->_loadEditData($id);
            } catch (Exception $exception) {
                return $this->_getError();
            }
        } else {
            $model = $this->_createEditData();
        }

        $data = $this->_session->getFormData(true);

        if (!empty($data)) {
            $model->setData($data);
        }

        $this->_coreRegistry->register(strtolower($this->_getEntityTitle()), $model);

        /** @var Page $resultPage */
        $resultPage = $this->_initAction();

        $newTitle = __('New') . ' ' . $this->_getEntityTitle();
        $editTitle = __('Edit') . ' ' . $this->_getEntityTitle();

        $resultPage->addBreadcrumb(
            $id ? $editTitle : $newTitle,
            $id ? $editTitle : $newTitle
        );

        $resultPage->getConfig()
            ->getTitle()
            ->prepend($model->getId() ? $editTitle . ': ' . $this->getTitle($model) : $newTitle);
        return $resultPage;
    }

    /**
     * @param AbstractModel $model
     * @return string
     */
    abstract protected function getTitle($model);

    /**
     * @return Page|Redirect
     */
    protected function _getError()
    {
        $this->messageManager->addErrorMessage(__('This ' . strtolower($this->_getEntityTitle()) . ' no longer exists.'));
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Init actions
     *
     * @return Page
     */
    protected function _initAction()
    {
        $manageTitle = __('Manage') . ' ' . $this->_getEntityTitle();
        /** @var Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->addBreadcrumb($this->_getEntityTitle(), $this->_getEntityTitle());
        $resultPage->addBreadcrumb($manageTitle, $manageTitle);
        return $resultPage;
    }

    /**
     * @param int $id
     * @return AbstractModel|Object
     */
    protected function _loadEditData($id){
        /** @var RepositoryInterface $repository */
        $repository = $this->_objectManager->get($this->_getRepositoryInterface());
        return $repository->getById($id);
    }

    /**
     * @return AbstractModel|Object
     */
    protected function _createEditData(){
        /** @var FactoryInterface $factory */
        $factory = $this->_objectManager->get($this->_getFactory());
        return $factory->create();
    }

    /**
     * @return string
     */
    abstract protected function _getFactory();
}