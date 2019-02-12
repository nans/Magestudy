<?php

namespace Magestudy\ProductExtensionAttribute\Plugin;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\Search\SearchCriteriaBuilderFactory;
use Magento\Framework\Api\FilterBuilder;
use Magento\Catalog\Api\Data\ProductExtensionFactory;
use Magestudy\ProductExtensionAttribute\Api\Data\SalesInformationInterface;
use Magestudy\ProductExtensionAttribute\Model\Repository\SalesInformationRepository;

class ProductAttributeUpdater
{
    /**
     * @var SalesInformationRepository
     */
    private $salesInformationRepository;

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
     * @var ProductExtensionFactory
     */
    private $productExtensionFactory;

    /**
     * @var string
     */
    private $orderStatus;

    /**
     * @param SalesInformationRepository $salesInformationRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory
     * @param FilterBuilder $filterBuilder
     * @param ProductExtensionFactory $productExtensionFactory
     * @param string $orderStatus
     */
    public function __construct(
        SalesInformationRepository $salesInformationRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory,
        FilterBuilder $filterBuilder,
        ProductExtensionFactory $productExtensionFactory,
        $orderStatus = ''
    ) {
        $this->salesInformationRepository = $salesInformationRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
        $this->filterBuilder = $filterBuilder;
        $this->productExtensionFactory = $productExtensionFactory;
        $this->orderStatus = $orderStatus;
    }

    /**
     * @param ProductRepositoryInterface $subject
     * @param ProductInterface $product
     * @return ProductInterface
     */
    public function afterGetById(ProductRepositoryInterface $subject, ProductInterface $product)
    {
        $this->loadExtensionAttributes($product);

        return $product;
    }

    //TODO The same for afterGet(...)
    //TODO The same for every item in afterGetList()

    /**
     * @param ProductInterface $product
     */
    protected function loadExtensionAttributes(ProductInterface & $product)
    {
        $productId = $product->getId();

        $searchCriteriaBuilder = $this->searchCriteriaBuilderFactory->create();
        $filterProductId = $this->filterBuilder->create()->setConditionType("eq")->setValue($productId)->setField(SalesInformationInterface::KEY_PRODUCT_ID);
        $filterOrderStatus = $this->filterBuilder->create()->setConditionType("eq")->setValue($this->orderStatus)->setField(SalesInformationInterface::KEY_ORDER_STATUS);
        $searchCriteriaWithFilters = $searchCriteriaBuilder->addFilter($filterProductId)->addFilter($filterOrderStatus)->create();
        $items = $this->salesInformationRepository->getList($searchCriteriaWithFilters)->getItems();

        $extensionAttributes = $product->getExtensionAttributes();
        if (empty($extensionAttributes)) {
            $extensionAttributes = $this->productExtensionFactory->create();
        }

        if (count($items) > 0) {
            $extensionAttributes->setSalesInformation(array_shift($items));
        }

        $product->setExtensionAttributes($extensionAttributes);
    }
}