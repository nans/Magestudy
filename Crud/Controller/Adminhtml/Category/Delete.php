<?php

namespace Magestudy\Crud\Controller\Adminhtml\Category;

use Magestudy\Crud\Api\CategoryRepositoryInterface;
use Magestudy\Crud\Controller\Adminhtml\AbstractDelete;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\Category;

class Delete extends AbstractDelete
{
    /**
     * @return string
     */
    protected function _getAclResource()
    {
        return AclResources::CATEGORY_DELETE;
    }

    protected function _deleteById($id)
    {
        /** @var CategoryRepositoryInterface $repository */
        $repository = $this->_objectManager->get(CategoryRepositoryInterface::class);
        $repository->deleteById($id);
    }

    /**
     * @return string
     */
    protected function _getEntityTitle()
    {
        return Category::ENTITY_TITLE;
    }
}