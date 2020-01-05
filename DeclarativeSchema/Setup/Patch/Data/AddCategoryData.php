<?php

namespace Magestudy\DeclarativeSchema\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddCategoryData implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * @return string[]
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @return string[]
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @return $this
     */
    public function apply()
    {
        $adapter = $this->moduleDataSetup->getConnection()->startSetup();
        $adapter->insert('nans_ds_category', ['title' => 'One', 'tag' => 'First']);
        $this->moduleDataSetup->getConnection()->endSetup();

        return $this;
    }
}