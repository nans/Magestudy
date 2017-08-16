<?php

namespace Magestudy\Crud\Controller\Adminhtml\Tag;

use Magento\Framework\Model\AbstractModel;
use Magestudy\Crud\Api\Data\TagInterface;
use Magestudy\Crud\Api\TagRepositoryInterface;
use Magestudy\Crud\Controller\Adminhtml\AbstractEdit;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\Tag;
use Magestudy\Crud\Model\TagFactory;

class Edit extends AbstractEdit
{
    /**
     * @param AbstractModel|TagInterface $model
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
        return Tag::ENTITY_TITLE;
    }

    /**
     * @param int $id
     * @return AbstractModel|TagInterface
     */
    protected function _loadEditData($id)
    {
        /** @var TagRepositoryInterface $repository */
        $repository = $this->_objectManager->get(TagRepositoryInterface::class);
        return $repository->getById($id);
    }

    /**
     * @return AbstractModel|TagInterface
     */
    protected function _createEditData()
    {
        /** @var TagFactory $factory */
        $factory = $this->_objectManager->get(TagFactory::class);
        return $factory->create();
    }
}