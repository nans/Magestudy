<?php

namespace Magestudy\Crud\Api\Data;

interface CategoryInterface extends ChangeDateInterface, StatusSwitchInterface
{
    const ID = 'category_id';
    const TITLE = 'title';
    const DESCRIPTION = 'description';
    const ENTITY_TITLE = 'Category';

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
}