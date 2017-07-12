<?php

namespace Magestudy\Crud\Api\Data;

interface PostInterface
{
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
     * @return int
     */
    public function getIsActive();

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
     * @return string
     */
    public function getCreationTime();

    /**
     * @return string
     */
    public function getUpdateTime();

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
     * @param int $isActive
     */
    public function setIsActive($isActive);

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