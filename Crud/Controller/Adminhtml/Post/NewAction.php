<?php

namespace Magestudy\Crud\Controller\Adminhtml\Post;

use Magestudy\Crud\Controller\Adminhtml\AbstractNewAction;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\Post;

class NewAction extends AbstractNewAction
{
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
}