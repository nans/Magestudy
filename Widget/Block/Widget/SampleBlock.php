<?php

namespace Magestudy\Widget\Block\Widget;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilderFactory;

class SampleBlock extends Template implements BlockInterface
{
    protected $_template = "widget/sample_widget.phtml";

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var SearchCriteriaBuilderFactory
     */
    private $searchCriteriaBuilderFactory;

    /**
     * @param Template\Context $context
     * @param ProductRepositoryInterface $productRepository
     * @param SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        ProductRepositoryInterface $productRepository,
        SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
    }

    /**
     * @param $limit
     * @return \Magento\Catalog\Api\Data\ProductInterface[]
     */
    public function getProducts($limit)
    {
        $searchCriteriaBuilder = $this->searchCriteriaBuilderFactory->create();
        $searchCriteriaWithFilters = $searchCriteriaBuilder->setPageSize($limit)->create();

        return $this->productRepository->getList($searchCriteriaWithFilters)->getItems();
    }
}