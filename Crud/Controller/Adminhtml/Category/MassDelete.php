<?php

namespace Magestudy\Crud\Controller\Adminhtml\Category;

use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Controller\ResultFactory;
use Magestudy\Crud\Api\CategoryRepositoryInterface;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\ResourceModel\Category\Collection as CategoryCollection;
use Magento\Backend\App\Action;

class MassDelete extends Action
{
    /**
     * @var Filter
     */
    protected $_filter;

    /**
     * @param Context $context
     * @param Filter $filter
     */
    public function __construct(
        Context $context,
        Filter $filter
    ) {
        $this->_filter = $filter;
        parent::__construct($context);
    }

    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        /** @var CategoryRepositoryInterface $repository */
        $repository = $this->_objectManager->get(CategoryRepositoryInterface::class);

        /** @var CategoryCollection $collection */
        $collection = $this->_filter->getCollection($this->_objectManager->create(CategoryCollection::class));
        $collectionSize = $collection->getSize();
        if ($collectionSize > 0) {
            foreach ($collection as $item) {
                $repository->delete($item);
            }
        }
        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(AclResources::CATEGORY_DELETE);
    }
}