<?php

namespace Magestudy\Crud\Api;

interface RepositoryInterface
{
    /**
     * Save record.
     *
     * @param Object $object
     * @return Object
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save($object);

    /**
     * Retrieve record.
     *
     * @param int $id
     * @return Object
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($id);

    /**
     * Delete record.
     *
     * @param Object $object
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete($object);

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