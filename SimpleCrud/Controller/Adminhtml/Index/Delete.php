<?php

namespace Magestudy\SimpleCrud\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magestudy\SimpleCrud\Api\ReviewRepositoryInterface;

class Delete extends Action
{
    const ADMIN_RESOURCE = 'Magestudy_SimpleCrud::delete';

    /**
     * @var ReviewRepositoryInterface
     */
    private $reviewRepository;

    /**
     * @param Action\Context $context
     * @param ReviewRepositoryInterface $reviewRepository
     */
    public function __construct(
        Action\Context $context,
        ReviewRepositoryInterface $reviewRepository
    ) {
        parent::__construct($context);

        $this->reviewRepository = $reviewRepository;
    }

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $this->reviewRepository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('The review has been deleted.'));

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());

                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a review to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}