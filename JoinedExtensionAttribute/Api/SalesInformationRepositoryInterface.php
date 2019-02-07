<?php

namespace Magestudy\JoinedExtensionAttribute\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magestudy\JoinedExtensionAttribute\Api\Data\SalesInformationSearchResultsInterface;

interface SalesInformationRepositoryInterface
{
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return SalesInformationSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}