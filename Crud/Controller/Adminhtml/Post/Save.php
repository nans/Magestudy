<?php

namespace Magestudy\Crud\Controller\Adminhtml\Post;

use Magestudy\Crud\Api\Data\PostInterface;
use Magestudy\Crud\Api\PostRepositoryInterface;
use Magestudy\Crud\Controller\Adminhtml\AbstractSave;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Helper\ImageLoader;
use Magestudy\Crud\Model\PostFactory;

class Save extends AbstractSave
{
    const IMAGE_PATH = 'magestudy/post';

    /**
     * @param array $data
     * @return array
     */
    protected function _updateData(array $data)
    {
        $image = null;
        if (key_exists('image', $data)) {
            $image = $data[PostInterface::IMAGE]['value'];
        }

        /** @var ImageLoader $imageLoader */
        $imageLoader = $this->_objectManager->get(ImageLoader::class);
        $data[PostInterface::IMAGE] = $imageLoader->loadImage(self::IMAGE_PATH, $image);

        $data[PostInterface::STORE_IDS] = implode(',', $data[PostInterface::STORE_IDS]);
        return $data;
    }

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
        return __(PostInterface::ENTITY_TITLE);
    }

    /**
     * @return string
     */
    protected function _getRepositoryInterface()
    {
        return PostRepositoryInterface::class;
    }

    /**
     * @return string
     */
    protected function _getIdField()
    {
        return PostInterface::ID;
    }

    /**
     * @return string
     */
    protected function _getFactory()
    {
        return PostFactory::class;
    }
}