<?php

namespace Magestudy\Crud\Model;

use Magento\Framework\Model\AbstractModel;
use Magestudy\Crud\Api\Data\CategoryInterface;
use Magestudy\Crud\Model\ResourceModel\Category as ResourceModel;

class Category extends AbstractModel implements CategoryInterface
{
    /**
     * @return string|null
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * @return int
     */
    public function getIsActive()
    {
        return $this->getData(self::IS_ACTIVE);
    }

    /**
     * @param int
     */
    public function setIsActive($isActive)
    {
        $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->setData(self::TITLE, $title);
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->setData(self::DESCRIPTION, $description);
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