<?php

namespace Magestudy\Crud\Api\Data;

interface TagInterface
{
    const ID = 'tag_id';
    const TITLE = 'title';
    const ENTITY_TITLE = 'Tag';

    /**
     * @return int|null
     */
    public function getId();

    /**
     * @return string|null
     */
    public function getTitle();

    /**
     * @param int $id
     */
    public function setId($id);

    /**
     * @param string $title
     */
    public function setTitle($title);
}