<?php

namespace Magestudy\Crud\Controller\Adminhtml\Post;

use Magento\Framework\Model\AbstractModel;
use Magestudy\Crud\Api\Data\PostInterface;
use Magestudy\Crud\Api\PostRepositoryInterface;
use Magestudy\Crud\Api\PostTagRepositoryInterface;
use Magestudy\Crud\Controller\Adminhtml\AbstractEdit;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\Post;
use Magestudy\Crud\Model\PostFactory;

class Edit extends AbstractEdit
{
    /**
     * @param PostInterface $model
     * @return string
     */
    protected function getTitle($model)
    {
        return $model->getTitle();
    }

    /**
     * @return string
     */
    protected function _getAclResource()
    {
        return AclResources::POST_SAVE;
    }

    /**
     * @return string
     */
    protected function _getEntityTitle()
    {
        return Post::ENTITY_TITLE;
    }

    /**
     * @param int $id
     * @return AbstractModel|PostInterface
     */
    protected function _loadEditData($id)
    {
        /** @var PostRepositoryInterface $repository */
        $repository = $this->_objectManager->get(PostRepositoryInterface::class);
        $model = $repository->getById($id);
        /** @var PostTagRepositoryInterface $postTagRepository */
        $postTagRepository = $this->_objectManager->get(PostTagRepositoryInterface::class);
        $model->setData(Post::TAG, $postTagRepository->getTagIdsByPostId($id));
        return $model;
    }

    /**
     * @return AbstractModel|PostInterface
     */
    protected function _createEditData()
    {
        /** @var PostFactory $factory */
        $factory = $this->_objectManager->get(PostFactory::class);
        return $factory->create();
    }
}