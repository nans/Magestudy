<?php

namespace Magestudy\Crud\Api;

use Magestudy\Crud\Api\Data\PostInterface;

interface PostRepositoryInterface
{
    /**
     * Save record.
     *
     * @param PostInterface $object
     * @return PostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(PostInterface $object);

    /**
     * Retrieve record.
     *
     * @param int $id
     * @return PostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($id);

    /**
     * Delete record.
     *
     * @param PostInterface $object
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(PostInterface $object);

    /**
     * Delete record by ID.
     *
     * @param int $id
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($id);
}