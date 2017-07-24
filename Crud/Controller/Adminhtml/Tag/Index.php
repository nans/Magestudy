<?php

namespace Magestudy\Crud\Controller\Adminhtml\Tag;

use Magestudy\Crud\Controller\Adminhtml\AbstractIndex;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\Tag;

class Index extends AbstractIndex
{
    /**
     * @return string
     */
    protected function _getAclResource()
    {
        return AclResources::TAG;
    }

    /**
     * @return string
     */
    protected function _getEntityTitle()
    {
        return __(Tag::ENTITY_TITLE);
    }
}