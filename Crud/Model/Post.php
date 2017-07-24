<?php

namespace Magestudy\Crud\Model;

use Magestudy\Crud\Api\Data\PostInterface;
use Magento\Framework\Model\AbstractModel;
use Magestudy\Crud\Api\Data\StatusSwitch;
use Magestudy\Crud\Model\ResourceModel\Post as ResourceModel;

class Post extends AbstractModel implements PostInterface, StatusSwitch
{
    const ID = 'post_id';
    const TITLE = 'title';
    const CONTENT = 'content';
    const IS_ACTIVE = 'is_active';
    const STORE_IDS = 'store_ids';
    const PUBLICATION_DATE = 'publication_date';
    const CATEGORY_ID = 'category_id';
    const IMAGE = 'image';
    const VIEWS = 'views';
    const CREATION_TIME = 'creation_time';
    const UPDATE_TIME = 'update_time';
    const TAG = 'tag';

    const ENTITY_TITLE = 'Post';

    const ENABLED_STATUS = 1;
    const DISABLED_STATUS = 0;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * @return int
     */
    public function getIsActive()
    {
        return $this->getData(self::IS_ACTIVE);
    }

    /**
     * @return string
     */
    public function getStoreIds()
    {
        return $this->getData(self::STORE_IDS);
    }

    /**
     * @return string
     */
    public function getPublicationDate()
    {
        return $this->getData(self::PUBLICATION_DATE);
    }

    /**
     * @return int
     */
    public function getCategoryId()
    {
        return $this->getData(self::CATEGORY_ID);
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->getData(self::IMAGE);
    }

    /**
     * @return int
     */
    public function getViews()
    {
        return $this->getData(self::VIEWS);
    }

    /**
     * @return string
     */
    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * @return string
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * @param  string $title
     */
    public function setTitle($title)
    {
        $this->setData(self::TITLE, $title);
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->setData(self::CONTENT, $content);
    }

    /**
     * @param int $isActive
     */
    public function setIsActive($isActive)
    {
        $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * @param string $storeIds
     */
    public function setStoreIds($storeIds)
    {
        $this->setData(self::STORE_IDS, $storeIds);
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->setData(self::IMAGE, $image);
    }

    /**
     * @param int $views
     */
    public function setViews($views)
    {
        $this->setData(self::VIEWS, $views);
    }

    public function activate()
    {
        $this->setIsActive(self::ENABLED_STATUS);
    }

    public function deactivate()
    {
        $this->setIsActive(self::DISABLED_STATUS);
    }
}