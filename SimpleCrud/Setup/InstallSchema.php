<?php

namespace Magestudy\SimpleCrud\Setup;

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
        $tableName = 'simple_crud_review';

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
                    'content', Table::TYPE_TEXT, 2000, ['nullable' => false],
                    'Review text'
                )
                ->addColumn(
                    'author', Table::TYPE_TEXT, 255, ['nullable' => false],
                    'Author'
                )
                ->addColumn(
                    'status', Table::TYPE_INTEGER, null, ['nullable' => false, 'unsigned' => true, 'default' => 0],
                    'Status'
                )
                ->addColumn(
                    'rating', Table::TYPE_SMALLINT, null, ['nullable' => false, 'unsigned' => true, 'default' => 0],
                    'Rating'
                )
                ->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'Creation Time'
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
                    $setup->getIdxName($tableName, ['status'], AdapterInterface::INDEX_TYPE_INDEX),
                    ['status'],
                    ['type' => AdapterInterface::INDEX_TYPE_INDEX]
                )
                ->addForeignKey(
                    $setup->getFkName('catalog_product_entity', 'entity_id', $tableName, 'product_id'),
                    'product_id',
                    $setup->getTable('catalog_product_entity'),
                    'entity_id',
                    Table::ACTION_CASCADE
                )
                ->setComment('Product Review');

            $connection->createTable($table);
        }
    }
}