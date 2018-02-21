<?php

namespace Magestudy\Crud\Controller\Adminhtml\Post;

use Magestudy\Crud\Api\Data\PostInterface;
use Magestudy\Crud\Api\PostRepositoryInterface;
use Magestudy\Crud\Controller\Adminhtml\AbstractMassDelete;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\ResourceModel\Post\Collection as PostCollection;

class MassDelete extends AbstractMassDelete
{
    /**
     * @return string
     */
    protected function _getAclResource()
    {
        return AclResources::POST_DELETE;
    }

    /**
     * @return string
     */
    protected function _getEntityTitle()
    {
        return __(PostInterface::ENTITY_TITLE);
    }

    /**
     * @return string
     */
    protected function _getCollectionClass()
    {
        return PostCollection::class;
    }

    /**
     * @return string
     */
    protected function _getRepositoryInterface()
    {
        return PostRepositoryInterface::class;
    }
}