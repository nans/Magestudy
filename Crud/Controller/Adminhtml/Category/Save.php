<?php

namespace Magestudy\Crud\Controller\Adminhtml\Category;

use Magestudy\Crud\Api\CategoryRepositoryInterface;
use Magestudy\Crud\Controller\Adminhtml\AbstractSave;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\Category;
use Magestudy\Crud\Model\Factory\CategoryFactory;

class Save extends AbstractSave
{
    /**
     * @return string
     */
    protected function _getAclResource()
    {
        return AclResources::CATEGORY_SAVE;
    }

    /**
     * @return string
     */
    protected function _getEntityTitle()
    {
        return Category::ENTITY_TITLE;
    }

    /**
     * @return string
     */
    protected function _getRepositoryInterface()
    {
        return CategoryRepositoryInterface::class;
    }

    /**
     * @return string
     */
    protected function _getIdField()
    {
        return Category::ID;
    }

    /**
     * @return string
     */
    protected function _getFactory()
    {
        return CategoryFactory::class;
    }
}