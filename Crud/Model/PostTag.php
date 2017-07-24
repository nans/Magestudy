<?php

namespace Magestudy\Crud\Model;

use Magestudy\Crud\Api\Data\PostTagInterface;
use Magento\Framework\Model\AbstractModel;
use Magestudy\Crud\Model\ResourceModel\PostTag as ResourceModel;

class PostTag extends AbstractModel implements PostTagInterface
{
    const ID = 'post_tag_id';
    const POST_ID = 'post_id';
    const TAG_ID = 'tag_id';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

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
}