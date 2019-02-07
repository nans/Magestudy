<?php

namespace Magestudy\JoinedExtensionAttribute\Model\Repository;

use Magento\Catalog\Api\Data\ProductExtensionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magestudy\JoinedExtensionAttribute\Api\Data\SalesInformationInterface;
use Magestudy\JoinedExtensionAttribute\Api\Data\SalesInformationSearchResultsInterface;
use Magestudy\JoinedExtensionAttribute\Api\Data\SalesInformationSearchResultsInterfaceFactory as SearchResultFactory;
use Magestudy\JoinedExtensionAttribute\Api\SalesInformationRepositoryInterface;
use Magestudy\JoinedExtensionAttribute\Model\ResourceModel\SalesInformation\Collection;
use Magestudy\JoinedExtensionAttribute\Model\ResourceModel\SalesInformation\CollectionFactory;

class SalesInformationRepository implements SalesInformationRepositoryInterface
{
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
     * @var ProductExtensionFactory
     */
    private $productExtensionFactory;

    /**
     * @param SearchResultFactory $searchResultFactory
     * @param CollectionFactory $collectionFactory
     * @param JoinProcessorInterface $joinProcessor
     * @param CollectionProcessorInterface $collectionProcessor
     * @param ProductExtensionFactory $productExtensionFactory
     */
    public function __construct(
        SearchResultFactory $searchResultFactory,
        CollectionFactory $collectionFactory,
        JoinProcessorInterface $joinProcessor,
        CollectionProcessorInterface $collectionProcessor,
        ProductExtensionFactory $productExtensionFactory
    ) {
        $this->searchResultFactory = $searchResultFactory;
        $this->collectionFactory = $collectionFactory;
        $this->joinProcessor = $joinProcessor;
        $this->collectionProcessor = $collectionProcessor;
        $this->productExtensionFactory = $productExtensionFactory;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return SalesInformationSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var SalesInformationSearchResultsInterface $searchResult */
        $searchResult = $this->searchResultFactory->create();

        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $this->joinProcessor->process($collection, SalesInformationInterface::class);
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setItems($collection->getItems());

        return $searchResult;
    }
}