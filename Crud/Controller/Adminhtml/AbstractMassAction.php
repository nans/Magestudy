<?php

namespace Magestudy\Crud\Controller\Adminhtml;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
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
    private $_repository;

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
     * @return Redirect
     * @throws LocalizedException|\Exception
     */
    public function execute()
    {
        /** @var AbstractCollection $collection */
        $collection = $this->_filter->getCollection($this->_objectManager->create($this->_getCollectionClass()));
        $collectionSize = $collection->getSize();
        if ($collectionSize > 0) {
            foreach ($collection as $item) {
                $this->_updateItem($item);
            }
        }
        $this->messageManager->addSuccessMessage($this->_getSuccessMessage($collectionSize));

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * @return RepositoryInterface
     */
    protected function _getRepository()
    {
        if (!$this->_repository) {
            $this->_repository = $this->_objectManager->get($this->_getRepositoryInterface());
        }
        return $this->_repository;
    }

    /**
     * @return string
     */
    abstract protected function _getCollectionClass();

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