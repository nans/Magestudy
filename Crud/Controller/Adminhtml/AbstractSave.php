<?php

namespace Magestudy\Crud\Controller\Adminhtml;

use Exception;
use RuntimeException;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Backend\Model\Session;
use Magento\Framework\Exception\LocalizedException;
use Magestudy\Crud\Api\FactoryInterface;
use Magestudy\Crud\Api\RepositoryInterface;


abstract class AbstractSave extends AbstractAction
{
    /**
     * @var RepositoryInterface
     */
    protected $_repository;

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            try {
                $data = $this->_updateData($data);
            } catch (Exception $exception) {
                $this->_showErrorMessage($exception);
                return $this->_getEditRedirect($resultRedirect);
            }

            $id = $this->getRequest()->getParam($this->_getIdField());
            /** @var AbstractModel $model */
            if ($id) {
                try {
                    $model = $this->_loadEditData($id);
                } catch (Exception $exception) {
                    $this->_showErrorMessage($exception);
                    return $this->_getEditRedirect($resultRedirect);
                }
            } else {
                $model = $this->_createEditData();
            }
            $model->setData($data);
            try {
                $this->_saveEditData($model);

                $this->messageManager->addSuccessMessage($this->_getEntityTitle() . ' ' . __('was saved.'));
                $this->_objectManager->get(Session::class)->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit',
                        ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (Exception $exception) {
                $this->_showErrorMessage($exception);
            }
            $this->_getSession()->setFormData($data);
            return $this->_getEditRedirect($resultRedirect);
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * @param Exception
     */
    protected function _showErrorMessage($exception)
    {
        $this->messageManager->addExceptionMessage($exception,
            __('Something went wrong while saving the data.'));
    }

    /**
     * @param Redirect
     * @return Redirect
     */
    protected function _getEditRedirect($resultRedirect)
    {
        return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam($this->_getIdField())]);
    }

    /**
     * @return RepositoryInterface
     */
    protected function _getRepository()
    {
        if (!$this->_repository) {
            $this->_repository = $this->_objectManager->create($this->_getRepositoryInterface());
        }
        return $this->_repository;
    }

    /**
     * @param int $id
     * @return AbstractModel|Object
     */
    protected function _loadEditData($id)
    {
        return $this->_getRepository()->getById($id);
    }

    /**
     * @param AbstractModel|Object $model
     */
    protected function _saveEditData($model)
    {
        $this->_getRepository()->save($model);
    }

    /**
     * @return string
     */
    abstract protected function _getIdField();

    /**
     * @return AbstractModel|Object
     */
    protected function _createEditData()
    {
        /** @var FactoryInterface $factory */
        $factory = $this->_objectManager->create($this->_getFactory());
        return $factory->create();
    }

    /**
     * @return string
     */
    abstract protected function _getFactory();

    /**
     * @param array $data
     * @return array
     */
    protected function _updateData(array $data)
    {
        return $data;
    }
}