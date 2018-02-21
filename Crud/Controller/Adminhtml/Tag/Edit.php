<?php

namespace Magestudy\Crud\Controller\Adminhtml\Tag;

use Magestudy\Crud\Api\Data\TagInterface;
use Magestudy\Crud\Api\TagRepositoryInterface;
use Magestudy\Crud\Controller\Adminhtml\AbstractEdit;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\TagFactory;

class Edit extends AbstractEdit
{
    /**
     * @param TagInterface $model
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
        return AclResources::TAG_SAVE;
    }

    /**
     * @return string
     */
    protected function _getEntityTitle()
    {
        return TagInterface::ENTITY_TITLE;
    }

    /**
     * @return string
     */
    protected function _getRepositoryInterface()
    {
        return TagRepositoryInterface::class;
    }

    /**
     * @return string
     */
    protected function _getFactory()
    {
        return TagFactory::class;
    }
}