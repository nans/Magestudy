<?php

namespace Magestudy\Crud\Api\Data;

interface TagInterface
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
     * @param int $id
     */
    public function setId($id);

    /**
     * @param string $title
     */
    public function setTitle($title);
}