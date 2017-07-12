<?php

namespace Magestudy\Crud\Controller\Adminhtml\Post;

use Exception;
use Magento\Backend\Model\Session;
use Magento\Framework\Exception\LocalizedException;
use Magestudy\Crud\Api\PostRepositoryInterface;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\Post;
use Magestudy\Crud\Model\Factory\PostFactory;
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
            $data[Post::STORE_IDS] = implode(',', $data[Post::STORE_IDS]);
            /** @var PostRepositoryInterface $repository */
            $repository = $this->_objectManager->create(PostRepositoryInterface::class);

            $id = $this->getRequest()->getParam(Post::ID);

            /** @var Post $model */
            if ($id) {
                try {
                    $model = $repository->getById($id);
                } catch (Exception $exception) {
                    $this->messageManager->addExceptionMessage($exception,
                        __('Something went wrong while saving the data.'));
                    return $resultRedirect->setPath('*/*/edit',
                        [Post::ID => $this->getRequest()->getParam(Post::ID)]);
                }
            } else {
                /** @var PostFactory $factory */
                $factory = $this->_objectManager->create(PostFactory::class);
                $model = $factory->create();
            }
            $model->setData($data);
            try {
                $repository->save($model);
                $this->messageManager->addSuccessMessage(__('Data was saved.'));
                $this->_objectManager->get(Session::class)->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit',
                        [Post::ID => $model->getId(), '_current' => true]);
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
                [Post::ID => $this->getRequest()->getParam(Post::ID)]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(AclResources::POST_SAVE);
    }
}