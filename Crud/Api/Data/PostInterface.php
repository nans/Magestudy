<?php

namespace Magestudy\Crud\Api\Data;

interface PostInterface extends  ChangeDateInterface, StatusSwitchInterface
{
    const ID = 'post_id';
    const TITLE = 'title';
    const CONTENT = 'content';
    const STORE_IDS = 'store_ids';
    const PUBLICATION_DATE = 'publication_date';
    const CATEGORY_ID = 'category_id';
    const IMAGE = 'image';
    const VIEWS = 'views';
    const TAG = 'tag';
    const ENTITY_TITLE = 'Post';

    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return string
     */
    public function getContent();

    /**
     * @return string
     */
    public function getStoreIds();

    /**
     * @return string
     */
    public function getPublicationDate();

    /**
     * @return int
     */
    public function getCategoryId();

    /**
     * @return string
     */
    public function getImage();

    /**
     * @return int
     */
    public function getViews();

    /**
     * @param int $id
     */
    public function setId($id);

    /**
     * @param  string $title
     */
    public function setTitle($title);

    /**
     * @param string $content
     */
    public function setContent($content);

    /**
     * @param string $storeIds
     */
    public function setStoreIds($storeIds);

    /**
     * @param string $image
     */
    public function setImage($image);

    /**
     * @param int $views
     */
    public function setViews($views);
}