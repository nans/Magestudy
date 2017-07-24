<?php

namespace Magestudy\Crud\Controller\Adminhtml\Tag;

use Magestudy\Crud\Controller\Adminhtml\AbstractNewAction;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\Tag;

class NewAction extends AbstractNewAction
{
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
        return Tag::ENTITY_TITLE;
    }
}