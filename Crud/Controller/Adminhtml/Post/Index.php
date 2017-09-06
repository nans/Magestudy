<?php

namespace Magestudy\Crud\Controller\Adminhtml\Post;

use Magestudy\Crud\Api\PostRepositoryInterface;
use Magestudy\Crud\Controller\Adminhtml\AbstractIndex;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\Post;

class Index extends AbstractIndex
{
    /**
     * @return string
     */
    protected function _getAclResource()
    {
        return AclResources::POST;
    }

    /**
     * @return string
     */
    protected function _getEntityTitle()
    {
        return __(Post::ENTITY_TITLE);
    }

    /**
     * @return string
     */
    protected function _getRepositoryInterface()
    {
        return PostRepositoryInterface::class;
    }
}