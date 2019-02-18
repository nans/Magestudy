<?php

namespace Magestudy\SimpleCrud\Api\Data;

interface ReviewInterface
{
    const KEY_ID         = 'id';
    const KEY_PRODUCT_ID = 'product_id';
    const KEY_CONTENT    = 'content';
    const KEY_STATUS     = 'status';
    const KEY_RATING     = 'rating';
    const KEY_AUTHOR     = 'author';
    const KEY_CREATED_AT = 'created_at';
    const KEY_UPDATED_AT = 'updated_at';

    /**
     * @return int
     */
    public function getProductId();

    /**
     * @return string
     */
    public function getContent();

    /**
     * @return int
     */
    public function getStatus();

    /**
     * @return string
     */
    public function getUpdatedAt();

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @return int
     */
    public function getRating();

    /**
     * @return string
     */
    public function getAuthor();

    /**
     * @param int $productId
     * @return void
     */
    public function setProductId($productId);

    /**
     * @param string $content
     * @return void
     */
    public function setContent($content);

    /**
     * @param int $status
     * @return void
     */
    public function setStatus($status);

    /**
     * @param string $rating
     */
    public function setRating($rating);

    /**
     * @param int $author
     */
    public function setAuthor($author);
}