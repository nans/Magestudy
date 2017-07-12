<?php

namespace Magestudy\Crud\Controller\Adminhtml\Category;

use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Controller\ResultFactory;
use Magestudy\Crud\Api\CategoryRepositoryInterface;
use Magestudy\Crud\Api\Data\CategoryInterface;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\Category;
use Magestudy\Crud\Model\ResourceModel\Category\Collection as CategoryCollection;
use Magento\Backend\App\Action;

class MassEnable extends Action
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
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        /** @var CategoryRepositoryInterface $repository */
        $repository = $this->_objectManager->get(CategoryRepositoryInterface::class);
        try {
            $collection = $this->_filter->getCollection($this->_objectManager->create(CategoryCollection::class));
            $collectionSize = $collection->getSize();
            if ($collectionSize > 0) {
                /** @var CategoryInterface $item */
                foreach ($collection as & $item) {
                    $this->_updateItem($item);
                    $repository->save($item);
                }
            }
            $this->messageManager->addSuccessMessage($this->_getSuccessMessage($collectionSize));
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__('Data not updated.'));
        }

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * @param CategoryInterface $item
     * @return void
     */
    protected function _updateItem(&$item)
    {
        $item->setIsActive(Category::ENABLED_STATUS);
    }

    /**
     * @param int $collectionSize
     * @return string
     */
    protected function _getSuccessMessage($collectionSize)
    {
        return __('A total of %1 record(s) have been enabled.', $collectionSize);
    }

    /**
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(AclResources::CATEGORY_SAVE);
    }
}