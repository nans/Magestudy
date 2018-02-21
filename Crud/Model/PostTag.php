<?php

namespace Magestudy\Crud\Model;

use Magento\Framework\Model\AbstractModel;
use Magestudy\Crud\Model\ResourceModel\PostTag as ResourceModel;
use Magestudy\Crud\Api\Data\PostTagInterface;

class PostTag extends AbstractModel implements PostTagInterface
{
    /**
     * @return int|null
     */
    public function getPostId()
    {
        return $this->getData(self::POST_ID);
    }

    /**
     * @param int $id
     */
    public function setPostId($id)
    {
        $this->setData(self::POST_ID, $id);
    }

    /**
     * @return int|null
     */
    public function getTagId()
    {
        return $this->getData(self::TAG_ID);
    }

    /**
     * @param int $id
     */
    public function setTagId($id)
    {
        $this->setData(self::TAG_ID, $id);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}