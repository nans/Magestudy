<?php

namespace Magestudy\Crud\Api;

use Magestudy\Crud\Api\Data\TagInterface;

interface TagRepositoryInterface
{
    /**
     * Save record.
     *
     * @param TagInterface $object
     * @return TagInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(TagInterface $object);

    /**
     * Retrieve record.
     *
     * @param int $id
     * @return TagInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($id);

    /**
     * Delete record.
     *
     * @param TagInterface $object
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(TagInterface $object);

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