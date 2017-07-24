<?php

namespace Magestudy\Crud\Controller\Adminhtml;

use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Controller\ResultFactory;
use Magestudy\Crud\Api\RepositoryInterface;

abstract class AbstractMassAction extends AbstractAction
{
    /**
     * @var Filter
     */
    protected $_filter;

    /**
     * @var RepositoryInterface
     */
    protected $_repository;

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
        /** @var \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection $collection */
        $collection = $this->_filter->getCollection($this->_objectManager->create($this->_getCollectionClass()));
        $collectionSize = $collection->getSize();
        if ($collectionSize > 0) {
            foreach ($collection as $item) {
                $this->_updateItem($item);
            }
        }
        $this->messageManager->addSuccessMessage($this->_getSuccessMessage($collectionSize));

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }


    protected function _getRepository()
    {
        if (!$this->_objectManager->get($this->_getRepositoryClass())) {
            $this->_repository = $this->_objectManager->get($this->_getRepositoryClass());
        }
        return $this->_repository;
    }

    /**
     * @return string
     */
    abstract protected function _getCollectionClass();

    /**
     * @return string
     */
    abstract protected function _getRepositoryClass();

    /**
     * @param int $collectionSize
     * @return string
     */
    abstract protected function _getSuccessMessage($collectionSize);

    /**
     * @param Object $item
     * @return void
     */
    abstract protected function _updateItem(&$item);
}