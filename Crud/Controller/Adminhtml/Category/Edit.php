<?php

namespace Magestudy\Crud\Controller\Adminhtml\Category;

use Magento\Framework\Model\AbstractModel;
use Magestudy\Crud\Api\CategoryRepositoryInterface;
use Magestudy\Crud\Api\Data\CategoryInterface;
use Magestudy\Crud\Controller\Adminhtml\AbstractEdit;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\Category;
use Magestudy\Crud\Model\CategoryFactory;

class Edit extends AbstractEdit
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
     * @param int $id
     * @return AbstractModel|CategoryInterface
     */
    protected function _loadEditData($id)
    {
        /** @var CategoryRepositoryInterface $repository */
        $repository = $this->_objectManager->get(CategoryRepositoryInterface::class);
        return $repository->getById($id);
    }

    /**
     * @param CategoryInterface $model
     * @return string
     */
    protected function getTitle($model)
    {
        return $model->getTitle();
    }

    /**
     * @return AbstractModel|CategoryInterface
     */
    protected function _createEditData()
    {
        /** @var CategoryFactory $factory */
        $factory = $this->_objectManager->get(CategoryFactory::class);
        return $factory->create();
    }
}