<?php

namespace Magestudy\Crud\Api\Data;

interface PostTagInterface
{
    const ID = 'post_tag_id';
    const POST_ID = 'post_id';
    const TAG_ID = 'tag_id';

    /**
     * @return int|null
     */
    public function getId();

    /**
     * @param int $id
     */
    public function setId($id);

    /**
     * @return int|null
     */
    public function getPostId();

    /**
     * @param int $id
     */
    public function setPostId($id);

    /**
     * @return int|null
     */
    public function getTagId();

    /**
     * @param int $id
     */
    public function setTagId($id);
}