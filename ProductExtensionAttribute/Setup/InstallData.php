<?php

namespace Magestudy\ProductExtensionAttribute\Setup;

use Magento\Catalog\Model\Product\Attribute\Source\Status;
use Magento\Catalog\Model\Product\Visibility;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Catalog\Model\Product;
use Magestudy\ProductExtensionAttribute\Api\Data\SalesInformationInterface;
use Magestudy\ProductExtensionAttribute\Model\Repository\SalesInformationRepository;
use Magestudy\ProductExtensionAttribute\Model\SalesInformationFactory;

class InstallData implements InstallDataInterface
{
    /**
     * @var ProductFactory
     */
    private $productFactory;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var SalesInformationFactory
     */
    private $salesInformationFactory;

    /**
     * @var SalesInformationRepository
     */
    private $salesInformationRepository;

    /**
     * @var CategorySetupFactory
     */
    private $categorySetupFactory;

    /**
     * @param ProductFactory $productFactory
     * @param ProductRepositoryInterface $productRepository
     * @param SalesInformationFactory $salesInformationFactory
     * @param SalesInformationRepository $salesInformationRepository
     * @param CategorySetupFactory $categorySetupFactory
     */
    public function __construct(
        ProductFactory $productFactory,
        ProductRepositoryInterface $productRepository,
        SalesInformationFactory $salesInformationFactory,
        SalesInformationRepository $salesInformationRepository,
        CategorySetupFactory $categorySetupFactory,
        \Magento\Framework\App\State $state //TODO Uncomment for install on Magento 2.2
    ) {
        $this->productFactory = $productFactory;
        $this->productRepository = $productRepository;
        $this->salesInformationFactory = $salesInformationFactory;
        $this->salesInformationRepository = $salesInformationRepository;
        $this->categorySetupFactory = $categorySetupFactory;
        $state->setAreaCode(\Magento\Framework\App\Area::AREA_GLOBAL);//TODO Uncomment for install on Magento 2.2
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\StateException
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();
        $categorySetup = $this->categorySetupFactory->create();
        $entityTypeId = $categorySetup->getEntityTypeId(Product::ENTITY);
        $defaultAttributeSetId = $categorySetup->getDefaultAttributeSetId($entityTypeId);
        /** @var Product $productModel */
        $productModel = $this->productFactory->create();
        $productModel->setTypeId('simple');
        $productModel->setSku('productForSampleExtensionAttribute');
        $productModel->setName('NewSimpleProduct');
        $productModel->setWeight(1);
        $productModel->setData('product_has_weight', 1);
        $productModel->setPrice(50);
        $productModel->setVisibility(Visibility::VISIBILITY_BOTH);
        $productModel->setStatus(Status::STATUS_ENABLED);
        $productModel->setAttributeSetId($defaultAttributeSetId);
        $productModel->setStockData(
            array(
                'use_config_manage_stock' => 0,
                'manage_stock' => 1,
                'is_in_stock' => 1,
                'qty' => 100
            )
        );
        $productModel = $this->productRepository->save($productModel);

        $setup->getConnection()->insert("sales_information", [
            SalesInformationInterface::KEY_QTY          => 10,
            SalesInformationInterface::KEY_ORDER_STATUS => 'canceled',
            SalesInformationInterface::KEY_PRODUCT_ID   => $productModel->getId(),
        ]);

        $setup->endSetup();
    }
}