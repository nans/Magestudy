<?php

namespace Magestudy\Crud\Controller\Adminhtml\Category;

use Magestudy\Crud\Controller\Adminhtml\AbstractIndex;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\Category;

class Index extends AbstractIndex
{
    /**
     * @return string
     */
    protected function _getAclResource()
    {
        return AclResources::CATEGORY;
    }

    /**
     * @return string
     */
    protected function _getEntityTitle()
    {
        return __(Category::ENTITY_TITLE);
    }
}