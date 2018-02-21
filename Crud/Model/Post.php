<?php

namespace Magestudy\Crud\Model;

use Magento\Framework\Model\AbstractModel;
use Magestudy\Crud\Model\ResourceModel\Post as ResourceModel;
use Magestudy\Crud\Api\Data\PostInterface;

class Post extends AbstractModel implements PostInterface
{
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

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->getIsActive() == self::ENABLED_STATUS;
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}