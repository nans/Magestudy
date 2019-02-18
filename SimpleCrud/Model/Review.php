<?php

namespace Magestudy\SimpleCrud\Model;

use Magento\Framework\Model\AbstractModel;
use Magestudy\SimpleCrud\Api\Data\ReviewInterface;
use Magestudy\SimpleCrud\Model\ResourceModel\Review as ResourceModel;

class Review extends AbstractModel implements ReviewInterface
{
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'sc_review';

    /**
     * Parameter name in event
     * In observe method you can use $observer->getEvent()->getRule() in this case
     *
     * @var string
     */
    protected $_eventObject = 'review';

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
        parent::_construct();
        $this->_init(ResourceModel::class);
    }

    /**
     * @return int
     */
    public function getRating()
    {
        return $this->getData(self::KEY_RATING);
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->getData(self::KEY_AUTHOR);
    }

    /**
     * @param string $rating
     */
    public function setRating($rating)
    {
        $this->setData(self::KEY_RATING, $rating);
    }

    /**
     * @param int $author
     */
    public function setAuthor($author)
    {
        $this->setData(self::KEY_AUTHOR, $author);
    }

    public function getId()
    {
        return $this->getData(self::KEY_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setId($id)
    {
        return $this->setData(self::KEY_ID, $id);
    }
}