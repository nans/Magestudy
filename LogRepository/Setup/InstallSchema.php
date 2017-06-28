<?php

namespace Magestudy\LogRepository\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magestudy\LogRepository\Model\Log as Model;
use Magestudy\LogRepository\Model\ResourceModel\Log as ResourceModel;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     *
     * @return void
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;

        $installer->startSetup();

        if (!$installer->tableExists(ResourceModel::MAIN_TABLE)) {
            $table = $installer->getConnection()->newTable($installer->getTable(ResourceModel::MAIN_TABLE))
                ->addColumn(
                    Model::ID, Table::TYPE_INTEGER, null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary' => true,
                    ], 'Log Id'
                )
                ->addColumn(
                    Model::DATE, Table::TYPE_TIMESTAMP, null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'Created At'
                )
                ->addColumn(
                    Model::CONTENT, Table::TYPE_TEXT, '2M', ['nullable' => false],
                    'Content'
                )
                ->setComment('Logs Table');
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}