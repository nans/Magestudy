<?php

namespace Magestudy\SimpleCrud\Model\Repository;

use Exception;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Model\AbstractModel;
use Magestudy\SimpleCrud\Api\Data\ReviewInterface;
use Magestudy\SimpleCrud\Api\Data\ReviewSearchResultsInterface;
use Magestudy\SimpleCrud\Api\Data\ReviewSearchResultsInterfaceFactory as SearchResultFactory;
use Magestudy\SimpleCrud\Api\ReviewRepositoryInterface;
use Magestudy\SimpleCrud\Model\ResourceModel\Review\Collection;
use Magestudy\SimpleCrud\Model\ReviewFactory as ReviewFactory;
use Magestudy\SimpleCrud\Model\ResourceModel\Review\CollectionFactory;
use Magestudy\SimpleCrud\Model\ResourceModel\Review as ReviewResource;

class ReviewRepository implements ReviewRepositoryInterface
{
    /**
     * @var array
     */
    protected $instances = [];

    /**
     * @var SearchResultFactory
     */
    private $searchResultFactory;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var JoinProcessorInterface
     */
    private $joinProcessor;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var ReviewFactory
     */
    private $reviewFactory;

    /**
     * @var ReviewResource
     */
    private $reviewResource;

    /**
     * @param SearchResultFactory $searchResultFactory
     * @param CollectionFactory $collectionFactory
     * @param JoinProcessorInterface $joinProcessor
     * @param CollectionProcessorInterface $collectionProcessor
     * @param ReviewFactory $reviewFactory
     * @param ReviewResource $reviewResource
     */
    public function __construct(
        SearchResultFactory $searchResultFactory,
        CollectionFactory $collectionFactory,
        JoinProcessorInterface $joinProcessor,
        CollectionProcessorInterface $collectionProcessor,
        ReviewFactory $reviewFactory,
        ReviewResource $reviewResource
    ) {
        $this->searchResultFactory = $searchResultFactory;
        $this->collectionFactory = $collectionFactory;
        $this->joinProcessor = $joinProcessor;
        $this->collectionProcessor = $collectionProcessor;
        $this->reviewFactory = $reviewFactory;
        $this->reviewResource = $reviewResource;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return ReviewSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var ReviewSearchResultsInterface $searchResult */
        $searchResult = $this->searchResultFactory->create();

        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $this->joinProcessor->process($collection, ReviewInterface::class);
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setItems($collection->getItems());

        return $searchResult;
    }

    /**
     * @param ReviewInterface $review
     * @return ReviewInterface
     * @throws LocalizedException
     */
    public function save(ReviewInterface $review)
    {
        /** @var ReviewInterface|AbstractModel $review */
        try {
            $this->reviewResource->save($review);
        } catch (Exception $exception) {
            throw new CouldNotSaveException(__('Could not save the review: %1', $exception->getMessage()));
        }

        return $review;
    }

    /**
     * @param int $id
     * @return ReviewInterface
     * @throws LocalizedException
     */
    public function getById($id)
    {
        if (!isset($this->_instances[$id])) {
            /** @var ReviewInterface|AbstractModel $review */
            $review = $this->reviewFactory->create();
            $this->reviewResource->load($review, $id);
            if (!$review->getId()) {
                throw new NoSuchEntityException(__('Review does not exist'));
            }
            $this->instances[$id] = $review;
        }

        return $this->instances[$id];
    }

    /**
     * @param ReviewInterface $review
     * @return bool
     * @throws LocalizedException
     */
    public function delete(ReviewInterface $review)
    {
        /** @var ReviewInterface|AbstractModel $review */
        $id = $review->getId();
        try {
            unset($this->instances[$id]);
            $this->reviewResource->delete($review);
        } catch (Exception $e) {
            throw new StateException(__('Unable to remove review %1', $id));
        }
        unset($this->instances[$id]);

        return true;
    }

    /**
     * @param int $id
     * @return bool
     * @throws LocalizedException
     */
    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }
}