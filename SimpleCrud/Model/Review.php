<?php

namespace Magestudy\SimpleCrud\Model;

use Magento\Framework\Model\AbstractModel;
use Magestudy\SimpleCrud\Api\Data\ReviewInterface;
use Magestudy\SimpleCrud\Model\ResourceModel\Review as ResourceModel;

class Review extends AbstractModel implements ReviewInterface
{
    /**
     * @return int
     */
    public function getProductId()
    {
        return $this->getData(self::KEY_PRODUCT_ID);
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->getData(self::KEY_CONTENT);
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->getData(self::KEY_STATUS);
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::KEY_UPDATED_AT);
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(self::KEY_CREATED_AT);
    }

    /**
     * @param int $productId
     * @return void
     */
    public function setProductId($productId)
    {
        $this->setData(self::KEY_PRODUCT_ID, $productId);
    }

    /**
     * @param string $content
     * @return void
     */
    public function setContent($content)
    {
        $this->setData(self::KEY_CONTENT, $content);
    }

    /**
     * @param int $status
     * @return void
     */
    public function setStatus($status)
    {
        $this->setData(self::KEY_STATUS, $status);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}