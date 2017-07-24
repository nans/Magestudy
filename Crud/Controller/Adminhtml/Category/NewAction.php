<?php

namespace Magestudy\Crud\Controller\Adminhtml\Category;

use Magestudy\Crud\Controller\Adminhtml\AbstractNewAction;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\Category;

class NewAction extends AbstractNewAction
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
}