<?php

namespace Magestudy\Crud\Observer\Post;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magestudy\Crud\Api\Data\PostInterface;
use Magestudy\Crud\Api\Data\PostTagInterface;
use Magestudy\Crud\Api\PostTagRepositoryInterface;
use Magestudy\Crud\Model\PostTagFactory;
use Magestudy\Crud\Model\ResourceModel\PostTag\Collection as PostTagCollection;

class UpdateTag implements ObserverInterface
{
    /**
     * @var PostTagCollection
     */
    protected $_postTagCollection;

    /**
     * @var PostTagFactory
     */
    protected $_postTagFactory;

    /**
     * @var PostTagRepositoryInterface
     */
    protected $_postTagRepository;

    /**
     * @param PostTagRepositoryInterface $postTagRepository
     * @param PostTagFactory $postTagFactory
     * @param PostTagCollection $postTagCollection
     */
    public function __construct(
        PostTagRepositoryInterface $postTagRepository,
        PostTagFactory $postTagFactory,
        PostTagCollection $postTagCollection
    ) {
        $this->_postTagFactory = $postTagFactory;
        $this->_postTagRepository = $postTagRepository;
        $this->_postTagCollection = $postTagCollection;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $id = $observer->getData(PostInterface::ID);
        $tags = $observer->getData(PostInterface::TAG);
        if ($id) {
            $this->_updatePostTags($id, $tags);
        }
    }

    /**
     * @param int $postId
     * @param array $newTagsArray
     */
    protected function _updatePostTags($postId, $newTagsArray)
    {
        if (!is_array($newTagsArray)) {
            $newTagsArray = [];
        }

        $oldTagsArray = $this->_postTagCollection->getItemsByColumnValue(PostTagInterface::POST_ID, $postId);
        $oldIds = [];
        /** @var PostTagInterface $postTag */
        foreach ($oldTagsArray as $postTag) {
            $oldIds[] = $postTag->getTagId();
        }

        $this->_removeNotChangedTags($oldIds, $newTagsArray);
        $this->_deleteTags($postId, $oldIds);
        $this->_saveTags($postId, $newTagsArray);
    }

    /**
     * @param array &$oldIds
     * @param array &$newTagsArray
     */
    protected function _removeNotChangedTags(& $oldIds, & $newTagsArray)
    {
        $concurrences = array_intersect($oldIds, $newTagsArray);
        foreach ($concurrences as $concurrence) {
            if (($key = array_search($concurrence, $oldIds)) !== false) {
                unset($oldIds[$key]);
            }
            if (($key = array_search($concurrence, $newTagsArray)) !== false) {
                unset($newTagsArray[$key]);
            }
        }
    }

    /**
     * @param int $postId
     * @param array $idsForDelete
     */
    protected function _deleteTags($postId, $idsForDelete)
    {
        if (count($idsForDelete) > 0) {
            foreach ($idsForDelete as $tagId) {
                $this->_postTagRepository->deleteByPostAndTagId($postId, $tagId);
            }
        }
    }

    /**
     * @param int $postId
     * @param array $idsForSave
     */
    protected function _saveTags($postId, $idsForSave)
    {
        /** @var PostTagInterface $postTag */
        if (count($idsForSave) > 0) {
            foreach ($idsForSave as $tagId) {
                $postTag = $this->_postTagFactory->create();
                $postTag->setPostId($postId);
                $postTag->setTagId($tagId);
                $this->_postTagRepository->save($postTag);
            }
        }
    }
}