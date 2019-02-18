<?php

namespace Magestudy\SimpleCrud\Controller\Adminhtml\Index;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magestudy\SimpleCrud\Api\Data\ReviewInterface;
use Magestudy\SimpleCrud\Api\ReviewRepositoryInterface;
use Magestudy\SimpleCrud\Model\ReviewFactory;

class Edit extends Action
{
    const ADMIN_RESOURCE = 'Magestudy_SimpleCrud::review';

    /**
     * @var ReviewRepositoryInterface
     */
    private $reviewRepository;

    /**
     * @var ReviewFactory
     */
    private $reviewFactory;

    /**
     * @param Context $context
     * @param ReviewRepositoryInterface $reviewRepository
     * @param ReviewFactory $reviewFactory
     */
    public function __construct(
        Context $context,
        ReviewRepositoryInterface $reviewRepository,
        ReviewFactory $reviewFactory
    ) {
        parent::__construct($context);
        $this->reviewRepository = $reviewRepository;
        $this->reviewFactory = $reviewFactory;
    }


    /**
     * @return void
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        if ($id) {
            try {
                /** @var ReviewInterface $model */
                $model = $this->reviewRepository->getById($id);
            } catch (Exception $exception) {
                $this->messageManager->addErrorMessage(__('This review no longer exists.'));
                $this->_redirect('review/*');

                return;
            }
        } else {
            $model = $this->reviewFactory->create();
        }

        $this->_initAction();
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Reviews'));
        $this->_view->getPage()->getConfig()->getTitle()->prepend(
            $model->getId() ? __("Edit Review '%1'", $model->getId()) : __('New Review')
        );

        $breadcrumb = $id ? __('Edit Rule') : __('New Rule');
        $this->_addBreadcrumb($breadcrumb, $breadcrumb);
        $this->_view->renderLayout();
    }

    /**
     * @return $this
     */
    protected function _initAction()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu('Magestudy_Crud::review');

        return $this;
    }
}
