<?php

namespace Magestudy\LogRepository\Api\Data;

interface LogInterface
{
    /**
     * @param int $id
     */
    public function setId($id);

    /**
     * @return int
     */
    public function getId();

    /**
     * @param string $date
     */
    public function setDate($date);

    /**
     * @return string
     */
    public function getDate();

    /**
     * @param string $content
     */
    public function setContent($content);

    /**
     * @return string
     */
    public function getContent();
}