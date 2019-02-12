<?php

namespace Magestudy\ProductExtensionAttribute\Api\Data;

interface SalesInformationSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get list.
     *
     * @return SalesInformationInterface[]
     */
    public function getItems();

    /**
     * Set list.
     *
     * @param SalesInformationInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
