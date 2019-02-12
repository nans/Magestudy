<?php

namespace Magestudy\ProductExtensionAttribute\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magestudy\ProductExtensionAttribute\Api\Data\SalesInformationSearchResultsInterface;

interface SalesInformationRepositoryInterface
{
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return SalesInformationSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}