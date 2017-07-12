<?php

namespace Magestudy\Crud\Controller\Adminhtml\Category;

use Exception;
use Magento\Backend\Model\Session;
use Magento\Framework\Exception\LocalizedException;
use Magestudy\Crud\Api\CategoryRepositoryInterface;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\Category;
use Magestudy\Crud\Model\Factory\CategoryFactory;
use Magento\Backend\App\Action;

class Save extends Action
{
    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            /** @var CategoryRepositoryInterface $repository */
            $repository = $this->_objectManager->create(CategoryRepositoryInterface::class);

            $id = $this->getRequest()->getParam(Category::ID);

            /** @var Category $model */
            if ($id) {
                try {
                    $model = $repository->getById($id);
                } catch (Exception $exception) {
                    $this->messageManager->addExceptionMessage($exception,
                        __('Something went wrong while saving the data.'));
                    return $resultRedirect->setPath('*/*/edit',
                        [Category::ID => $this->getRequest()->getParam(Category::ID)]);
                }
            } else {
                /** @var CategoryFactory $factory */
                $factory = $this->_objectManager->create(CategoryFactory::class);
                $model = $factory->create();
            }
            $model->setData($data);
            try {
                $repository->save($model);
                $this->messageManager->addSuccessMessage(__('Data was saved.'));
                $this->_objectManager->get(Session::class)->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit',
                        [Category::ID => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage($e, __('Something went wrong while saving data.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit',
                [Category::ID => $this->getRequest()->getParam(Category::ID)]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(AclResources::CATEGORY_SAVE);
    }
}