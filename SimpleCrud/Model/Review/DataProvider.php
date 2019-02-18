<?php

namespace Magestudy\SimpleCrud\Model\Review;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Magestudy\SimpleCrud\Api\Data\ReviewInterface;
use Magestudy\SimpleCrud\Model\ResourceModel\Review\Collection;
use Magestudy\SimpleCrud\Model\ResourceModel\Review\CollectionFactory;
use Magestudy\SimpleCrud\Model\Review;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        /** @var ReviewInterface|Review $review */
        foreach ($items as $review) {
            $this->loadedData[$review->getId()] = $review->getData();
        }

        return $this->loadedData;
    }
}
