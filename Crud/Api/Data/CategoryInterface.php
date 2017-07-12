<?php

namespace Magestudy\Crud\Api\Data;

interface CategoryInterface
{
    /**
     * @return int|null
     */
    public function getId();

    /**
     * @return string|null
     */
    public function getTitle();

    /**
     * @return string|null
     */
    public function getDescription();

    /**
     * @return int
     */
    public function getIsActive();

    /**
     * @param int
     */
    public function setIsActive($isActive);

    /**
     * @param int $id
     */
    public function setId($id);

    /**
     * @param string $title
     */
    public function setTitle($title);

    /**
     * @param string $description
     */
    public function setDescription($description);

    /**
     * @return string
     */
    public function getCreationTime();

    /**
     * @return string
     */
    public function getUpdateTime();
}