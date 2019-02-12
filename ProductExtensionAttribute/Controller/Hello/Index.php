<?php

namespace Magestudy\ProductExtensionAttribute\Controller\Hello;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Catalog\Api\ProductRepositoryInterface;

/** This class is not required for use Extension Attributes and created only for sample */
class Index extends Action
{
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @param Context $context
     * @param CustomerRepositoryInterface $customerRepository
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        Context $context,
        CustomerRepositoryInterface $customerRepository,
        ProductRepositoryInterface $productRepository
    ) {
        parent::__construct($context);
        $this->customerRepository = $customerRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * URL: .../index.php/ProductExtensionAttribute/hello/index
     */
    public function execute()
    {
        try {
            $product = $this->productRepository->getById(1); //TODO enter product id for test
            $attributes = $product->getExtensionAttributes();
            var_dump($attributes);
        } catch (\Throwable $throwable) {
            echo $throwable->getMessage();
        }

        die;
    }
}