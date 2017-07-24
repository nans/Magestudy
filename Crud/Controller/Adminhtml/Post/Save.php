<?php

namespace Magestudy\Crud\Controller\Adminhtml\Post;

use Magestudy\Crud\Api\PostRepositoryInterface;
use Magestudy\Crud\Controller\Adminhtml\AbstractSave;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\Post;
use Magestudy\Crud\Model\Factory\PostFactory;

class Save extends AbstractSave
{
    /**
     * @param array $data
     * @return array
     */
    protected function _updateData(array $data)
    {
        $data[Post::STORE_IDS] = implode(',', $data[Post::STORE_IDS]);
        return $data;
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
     * @return string
     */
    protected function _getRepositoryInterface()
    {
        return PostRepositoryInterface::class;
    }

    /**
     * @return string
     */
    protected function _getIdField()
    {
        return Post::ID;
    }

    /**
     * @return string
     */
    protected function _getFactory()
    {
        return PostFactory::class;
    }
}