<?php

namespace Magestudy\Crud\Controller\Adminhtml\Post;

use Magestudy\Crud\Api\PostRepositoryInterface;
use Magestudy\Crud\Controller\Adminhtml\AbstractDelete;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\Post;

class Delete extends AbstractDelete
{
    /**
     * @return string
     */
    protected function _getAclResource()
    {
        return AclResources::POST_DELETE;
    }

    protected function _deleteById($id)
    {
        /** @var PostRepositoryInterface $repository */
        $repository = $this->_objectManager->get(PostRepositoryInterface::class);
        $repository->deleteById($id);
    }

    /**
     * @return string
     */
    protected function _getEntityTitle()
    {
        return Post::ENTITY_TITLE;
    }
}