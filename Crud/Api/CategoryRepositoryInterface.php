<?php

namespace Magestudy\Crud\Api;

use Magestudy\Crud\Api\Data\CategoryInterface;

interface CategoryRepositoryInterface
{
    /**
     * Save record.
     *
     * @param CategoryInterface $object
     * @return CategoryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(CategoryInterface $object);

    /**
     * Retrieve record.
     *
     * @param int $id
     * @return CategoryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($id);

    /**
     * Delete record.
     *
     * @param CategoryInterface $object
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(CategoryInterface $object);

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