<?php

namespace Magestudy\SearchCriteria\Controller\Hello;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\Search\SearchCriteriaBuilderFactory;
use Magento\Framework\Api\FilterBuilder;

class Index extends Action
{
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var SearchCriteriaBuilderFactory
     */
    private $searchCriteriaBuilderFactory;

    /**
     * @var FilterBuilder
     */
    private $filterBuilder;

    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * @param Context $context
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory
     * @param FilterBuilder $filterBuilder
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        Context $context,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory,
        FilterBuilder $filterBuilder,
        CustomerRepositoryInterface $customerRepository
    ) {
        parent::__construct($context);
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
        $this->filterBuilder = $filterBuilder;
        $this->customerRepository = $customerRepository;
    }

    /**
     * URL: .../index.php/SearchCriteria/hello/index
     *
     * @return PageFactory
     */
    public function execute()
    {
        //With builder
        $searchCriteriaBuilder = $this->searchCriteriaBuilderFactory->create();
        $filter = $this->filterBuilder->create()->setConditionType("neq")->setValue(3)->setField(CustomerInterface::GENDER);
        $searchCriteriaGenderFirstAndTwoNeq = $searchCriteriaBuilder->addFilter($filter)->create();

        //without builder
        $searchCriteriaGenderOne = $this->searchCriteriaBuilder->addFilter(CustomerInterface::GENDER, 1, "eq")->create();
        $searchCriteriaGenderTwo = $this->searchCriteriaBuilder->addFilter(CustomerInterface::GENDER, 2, "eq")->create();
        $searchCriteriaFirst = $this->searchCriteriaBuilder->addFilter(CustomerInterface::FIRSTNAME, 'First', "like")->create();
        $searchCriteriaGenderFirstAndTwo = $this->searchCriteriaBuilder->addFilter(CustomerInterface::GENDER, [1, 2], "in")->create();

        //result
        try {
            $genderOneCustomers = $this->customerRepository->getList($searchCriteriaGenderOne)->getItems();
            $genderTwoCustomers = $this->customerRepository->getList($searchCriteriaGenderTwo)->getItems();
            $firstNameCustomer = $this->customerRepository->getList($searchCriteriaFirst)->getItems();
            $firstAndSecondGender = $this->customerRepository->getList($searchCriteriaGenderFirstAndTwo)->getItems();
            $firstAndSecondGenderNeq = $this->customerRepository->getList($searchCriteriaGenderFirstAndTwoNeq)->getItems();
            echo 'Gender 1 <pre>';
            var_dump($genderOneCustomers);
            echo '</pre>Gender 2 <pre>';
            var_dump($genderTwoCustomers);
            echo '</pre>First (name)<pre>';
            var_dump($firstNameCustomer);
            echo '</pre>Gender 1 and 2<pre>';
            var_dump($firstAndSecondGender);
            echo '</pre>';
            echo '</pre>Gender not 3<pre>';
            var_dump($firstAndSecondGenderNeq);
            echo '</pre>';
        } catch (\Throwable $throwable) {
            echo $throwable->getMessage();
        }

        die;
    }
}