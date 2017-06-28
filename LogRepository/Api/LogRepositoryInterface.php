<?php

namespace Magestudy\LogRepository\Api;

use Magestudy\LogRepository\Api\Data\LogInterface as ItemInterface;

Interface LogRepositoryInterface
{
    /**
     * Save record.
     *
     * @param ItemInterface $object
     * @return ItemInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(ItemInterface $object);

    /**
     * Retrieve record.
     *
     * @param int $id
     * @return ItemInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($id);

    /**
     * Delete record.
     *
     * @param ItemInterface $object
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(ItemInterface $object);

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