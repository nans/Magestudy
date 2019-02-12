<?php

namespace Magestudy\ProductExtensionAttribute\Setup;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @throws \Zend_Db_Exception
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();
        $this->_createCategoryTable($setup);
        $setup->endSetup();
    }

    /**
     * @param SchemaSetupInterface $setup
     * @throws \Zend_Db_Exception
     */
    private function _createCategoryTable($setup)
    {
        /** @var \Magento\Framework\DB\Adapter\AdapterInterface $connection */
        $connection = $setup->getConnection();
        $tableName = 'sales_information';

        if (!$setup->tableExists($tableName)) {
            $table = $connection->newTable($setup->getTable($tableName))
                ->addColumn(
                    'id', Table::TYPE_INTEGER, null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ], 'ID'
                )
                ->addColumn(
                    'product_id', Table::TYPE_INTEGER, null, ['nullable' => false, 'unsigned' => true],
                    'Product Id'
                )
                ->addColumn(
                    'order_status', Table::TYPE_TEXT, 25, ['nullable' => false],
                    'Order Status'
                )
                ->addColumn(
                    'qty', Table::TYPE_INTEGER, null, ['nullable' => false, 'unsigned' => true, 'default' => 0],
                    'Qty'
                )
                ->addColumn(
                    'updated_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
                    'Modification Time'
                )
                ->addIndex(
                    $setup->getIdxName($tableName, ['product_id'], AdapterInterface::INDEX_TYPE_INDEX),
                    ['product_id'],
                    ['type' => AdapterInterface::INDEX_TYPE_INDEX]
                )
                ->addIndex(
                    $setup->getIdxName($tableName, ['order_status'], AdapterInterface::INDEX_TYPE_INDEX),
                    ['order_status'],
                    ['type' => AdapterInterface::INDEX_TYPE_INDEX]
                )
                ->addForeignKey(
                    $setup->getFkName('catalog_product_entity', 'entity_id', $tableName, 'product_id'),
                    'product_id',
                    $setup->getTable('catalog_product_entity'),
                    'entity_id',
                    Table::ACTION_CASCADE
                )
                ->setComment('Product Sales Information');

            $connection->createTable($table);
        }
    }
}