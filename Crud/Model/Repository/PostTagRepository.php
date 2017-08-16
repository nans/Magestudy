<?php

namespace Magestudy\Crud\Model\Repository;

use Exception;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Exception\ValidatorException;
use Magestudy\Crud\Api\PostTagRepositoryInterface;
use Magestudy\Crud\Api\Data\PostTagInterface;
use Magestudy\Crud\Model\PostTagFactory;
use Magestudy\Crud\Model\ResourceModel\PostTag;
use Magestudy\Crud\Model\PostTag as PostTagModel;
use Magestudy\Crud\Model\ResourceModel\PostTag\Collection as PostTagCollection;

class PostTagRepository implements PostTagRepositoryInterface
{
    /**
     * @var array
     */
    protected $_instances = [];

    /**
     * @var PostTag
     */
    protected $_resource;

    /**
     * @var PostTagFactory
     */
    protected $_factory;

    /**
     * @var PostTagCollection
     */
    protected $_postTagCollection;

    public function __construct(
        PostTag $resource,
        PostTagFactory $factory,
        PostTagCollection $postTagCollection
    ) {
        $this->_resource = $resource;
        $this->_factory = $factory;
        $this->_postTagCollection = $postTagCollection;
    }

    /**
     * Save data.
     *
     * @param PostTagInterface $object
     * @return PostTagInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(PostTagInterface $object)
    {
        /** @var PostTagInterface|\Magento\Framework\Model\AbstractModel $object */
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
     * @return PostTagInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($id)
    {
        if (!isset($this->_instances[$id])) {
            /** @var PostTagInterface|\Magento\Framework\Model\AbstractModel $object */
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
     * @param int $postId
     * @param int $tagId
     * @return PostTagInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getByPostAndTagId($postId, $tagId)
    {
        foreach ($this->_instances as $instance) {
            /** @var PostTagInterface $instance */
            if ($instance->getTagId() == $tagId && $instance->getPostId() == $postId) {
                return $instance;
            }
        }

        /** @var PostTagInterface|\Magento\Framework\Model\AbstractModel $object */
        $postTag = $this->_resource->getIdByParams($postId, $tagId);
        if (!$postTag) {
            throw new NoSuchEntityException(__('Data does not exist'));
        }

        $object = $this->getById($postTag);

        if (!$object->getId()) {
            throw new NoSuchEntityException(__('Data does not exist'));
        }
        $this->_instances[$object->getId()] = $object;

        return $object;
    }

    /**
     * Delete data.
     *
     * @param PostTagInterface $object
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(PostTagInterface $object)
    {
        /** @var PostTagInterface|\Magento\Framework\Model\AbstractModel $object */
        $id = $object->getId();
        if (!$id) {
            return false;
        }
        try {
            $this->_resource->delete($object);
            unset($this->_instances[$id]);
        } catch (ValidatorException $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        } catch (Exception $e) {
            throw new StateException(
                __('Unable to remove %1', $id)
            );
        }
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

    /**
     * Delete data by post ID and tag ID.
     *
     * @param int $postId
     * @param int $tagId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteByPostAndTagId($postId, $tagId)
    {
        return $this->delete($this->getByPostAndTagId($postId, $tagId));
    }

    /**
     * Get all tag ids by post ID
     *
     * @param int $postId
     * @return array
     */
    public function getTagIdsByPostId($postId)
    {
        $ids = [];
        $items = $this->_postTagCollection->getItemsByColumnValue(PostTagModel::POST_ID, $postId);
        /** @var PostTagInterface $item */
        foreach ($items as $item) {
            $ids[] = $item->getTagId();
        }
        return $ids;
    }
}