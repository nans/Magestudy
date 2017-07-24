<?php

namespace Magestudy\Crud\Api;

use Magestudy\Crud\Api\Data\PostTagInterface;

interface PostTagRepositoryInterface
{
    /**
     * Save record.
     *
     * @param PostTagInterface $object
     * @return PostTagInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(PostTagInterface $object);

    /**
     * Retrieve record.
     *
     * @param int $id
     * @return PostTagInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($id);

    /**
     * Delete record.
     *
     * @param PostTagInterface $object
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(PostTagInterface $object);

    /**
     * Delete record by ID.
     *
     * @param int $id
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($id);

    /**
     * @param int $postId
     * @param int $tagId
     * @return PostTagInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getByPostAndTagId($postId, $tagId);

    /**
     * Delete data by post ID and tag ID.
     *
     * @param int $postId
     * @param int $tagId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteByPostAndTagId($postId, $tagId);

    /**
     * get all tag ids by post ID
     *
     * @param int $postId
     * @return array
     */
    public function getTagIdsByPostId($postId);
}