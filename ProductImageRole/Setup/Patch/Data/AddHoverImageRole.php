<?php

namespace Magestudy\ProductImageRole\Setup\Patch\Data;

use Magento\Catalog\Api\Data\ProductAttributeInterface;
use Magento\Eav\Model\AttributeSetRepository;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class AddHoverImageRole implements DataPatchInterface, PatchRevertableInterface
{
    const ATTRIBUTE_SET_CODE = 'Default';

    const ATTRIBUTE_GROUP = 'image-management';

    const ATTRIBUTE_CODE = 'hover_image';

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @var AttributeSetRepository
     */
    private $attributeSetRepository;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     * @param AttributeSetRepository $setRepository
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup, EavSetupFactory $eavSetupFactory, AttributeSetRepository $setRepository
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->attributeSetRepository = $setRepository;
    }

    /**
     * {@inheritdoc}
     * @return DataPatchInterface|void
     * @throws LocalizedException
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $eavSetup = $this->getEavSetup();

        if (!$eavSetup->getAttributeId(ProductAttributeInterface::ENTITY_TYPE_CODE, self::ATTRIBUTE_CODE)) {
            $eavSetup->addAttribute(
                ProductAttributeInterface::ENTITY_TYPE_CODE,
                self::ATTRIBUTE_CODE,
                [
                    'type'                    => 'varchar',
                    'label'                   => 'Hover Image',
                    'input'                   => 'media_image',
                    'required'                => false,
                    'frontend'                => \Magento\Catalog\Model\Product\Attribute\Frontend\Image::class,
                    'used_in_product_listing' => true,
                    'user_defined'            => true,
                    'visible'                 => true,
                    'visible_on_front'        => false,
                    'global'                  => ScopedAttributeInterface::SCOPE_GLOBAL,
                ]
            );
        }

        $eavSetup->addAttributeToSet(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            self::ATTRIBUTE_SET_CODE,
            self::ATTRIBUTE_GROUP,
            self::ATTRIBUTE_CODE
        );

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function revert()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $eavSetup = $this->getEavSetup();
        $eavSetup->removeAttribute(ProductAttributeInterface::ENTITY_TYPE_CODE, self::ATTRIBUTE_CODE);
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    private function getEavSetup(): EavSetup
    {
        return $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
    }
}
