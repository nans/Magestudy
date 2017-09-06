<?php

namespace Magestudy\Crud\Controller\Adminhtml\Tag;

use Magestudy\Crud\Api\TagRepositoryInterface;
use Magestudy\Crud\Controller\Adminhtml\AbstractMassDelete;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\ResourceModel\Tag\Collection as TagCollection;
use Magestudy\Crud\Model\Tag;

class MassDelete extends AbstractMassDelete
{
    /**
     * @return string
     */
    protected function _getAclResource()
    {
        return AclResources::TAG_DELETE;
    }

    /**
     * @return string
     */
    protected function _getEntityTitle()
    {
        return Tag::ENTITY_TITLE;
    }

    /**
     * @return string
     */
    protected function _getCollectionClass()
    {
        return TagCollection::class;
    }

    /**
     * @return string
     */
    protected function _getRepositoryInterface()
    {
        return TagRepositoryInterface::class;
    }
}