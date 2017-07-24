<?php

namespace Magestudy\Crud\Controller\Adminhtml\Tag;

use Magestudy\Crud\Api\TagRepositoryInterface;
use Magestudy\Crud\Controller\Adminhtml\AbstractDelete;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\Tag;

class Delete extends AbstractDelete
{
    /**
     * @return string
     */
    protected function _getAclResource()
    {
        return AclResources::TAG_DELETE;
    }

    protected function _deleteById($id)
    {
        /** @var TagRepositoryInterface $repository */
        $repository = $this->_objectManager->get(TagRepositoryInterface::class);
        $repository->deleteById($id);
    }

    /**
     * @return string
     */
    protected function _getEntityTitle()
    {
        return Tag::ENTITY_TITLE;
    }
}