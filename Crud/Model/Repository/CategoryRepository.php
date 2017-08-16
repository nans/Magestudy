<?php

namespace Magestudy\Crud\Model\Repository;

use Exception;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Exception\ValidatorException;
use Magestudy\Crud\Api\CategoryRepositoryInterface;
use Magestudy\Crud\Api\Data\CategoryInterface;
use Magestudy\Crud\Model\CategoryFactory;
use Magestudy\Crud\Model\ResourceModel\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * @var array
     */
    protected $_instances = [];

    /**
     * @var Category
     */
    protected $_resource;

    /**
     * @var CategoryFactory
     */
    protected $_factory;

    public function __construct(
        Category $resource,
        CategoryFactory $factory
    ) {
        $this->_resource = $resource;
        $this->_factory = $factory;
    }

    /**
     * Save data.
     *
     * @param CategoryInterface $object
     * @return CategoryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(CategoryInterface $object)
    {
        /** @var CategoryInterface|\Magento\Framework\Model\AbstractModel $object */
        try {
            $this->_resource->save($object);
        } catch (Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the record: %1',
                $exception->getMessage()
            ));
        }
        return $object;
    }

    /**
     * Retrieve data.
     *
     * @param int $id
     * @return CategoryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($id)
    {
        if (!isset($this->_instances[$id])) {
            /** @var CategoryInterface|\Magento\Framework\Model\AbstractModel $object */
            $object = $this->_factory->create();
            $this->_resource->load($object, $id);
            if (!$object->getId()) {
                throw new NoSuchEntityException(__('Data does not exist'));
            }
            $this->_instances[$id] = $object;
        }
        return $this->_instances[$id];
    }

    /**
     * Delete data.
     *
     * @param CategoryInterface $object
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(CategoryInterface $object)
    {
        /** @var CategoryInterface|\Magento\Framework\Model\AbstractModel $object */
        $id = $object->getId();
        try {
            unset($this->_instances[$id]);
            $this->_resource->delete($object);
        } catch (ValidatorException $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        } catch (Exception $e) {
            throw new StateException(
                __('Unable to remove %1', $id)
            );
        }
        unset($this->_instances[$id]);
        return true;
    }

    /**
     * Delete data by ID.
     *
     * @param int $id
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }
}