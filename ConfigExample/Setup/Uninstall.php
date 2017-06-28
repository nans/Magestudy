<?php

namespace Magestudy\ConfigExample\Setup;

use Magento\Framework\Setup\UninstallInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class Uninstall implements UninstallInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     *
     * @return void
     */
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $connection = $setup->getConnection();
        $connection->delete($setup->getTable('core_config_data'), ['path = ?' => 'magestudy/global/text_item']);
        $connection->delete($setup->getTable('core_config_data'), ['path = ?' => 'magestudy/first_group/select_item']);
        $connection->delete($setup->getTable('core_config_data'), ['path = ?' => 'magestudy_2/global/text_item']);
        $setup->endSetup();
    }
}