<?php

namespace Magestudy\Crud\Model;

use Magestudy\Crud\Api\Data\CategoryInterface;
use Magento\Framework\Model\AbstractModel;
use Magestudy\Crud\Api\Data\StatusSwitch;
use Magestudy\Crud\Model\ResourceModel\Category as ResourceModel;

class Category extends AbstractModel implements CategoryInterface, StatusSwitch
{
    const ID = 'category_id';
    const TITLE = 'title';
    const DESCRIPTION = 'description';
    const IS_ACTIVE = 'is_active';
    const CREATION_TIME = 'creation_time';
    const UPDATE_TIME = 'update_time';

    const ENTITY_TITLE = 'Category';

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
}