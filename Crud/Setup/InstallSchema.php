<?php

namespace Magestudy\Crud\Setup;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

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
        $setup->startSetup();
        $this->_createCategoryTable($setup);
        $this->_createPostTable($setup);
        $this->_createTagTable($setup);
        $this->_createPostTagTable($setup);
        $setup->endSetup();
    }

    /**
     * @param SchemaSetupInterface $setup
     */
    private function _createCategoryTable($setup)
    {
        /** @var \Magento\Framework\DB\Adapter\AdapterInterface $connection */
        $connection = $setup->getConnection();
        $tableName = 'crud_category';
        if (!$setup->tableExists($tableName)) {
            $table = $connection->newTable($setup->getTable($tableName))
                ->addColumn(
                    'category_id', Table::TYPE_INTEGER, null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary' => true,
                    ], 'ID'
                )
                ->addColumn(
                    'is_active', Table::TYPE_SMALLINT, null, ['nullable' => false, 'default' => 1],
                    'Is Active'
                )
                ->addColumn(
                    'title', Table::TYPE_TEXT, 255, ['nullable' => false],
                    'Title'
                )
                ->addColumn(
                    'description', Table::TYPE_TEXT, 1000, ['nullable' => false],
                    'Description'
                )
                ->addColumn(
                    'creation_time',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'Creation Time'
                )
                ->addColumn(
                    'update_time',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
                    'Modification Time'
                )
                ->addIndex(
                    $setup->getIdxName(
                        $tableName,
                        ['title'],
                        AdapterInterface::INDEX_TYPE_UNIQUE
                    ),
                    ['title'],
                    ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
                )
                ->setComment('Category');
            $connection->createTable($table);

            $connection->addIndex($tableName,
                $setup->getIdxName(
                    $tableName,
                    ['title'],
                    AdapterInterface::INDEX_TYPE_FULLTEXT
                ), ['title'], AdapterInterface::INDEX_TYPE_FULLTEXT);
        }
    }

    /**
     * @param SchemaSetupInterface $setup
     */
    private function _createPostTable($setup)
    {
        /** @var \Magento\Framework\DB\Adapter\AdapterInterface $connection */
        $connection = $setup->getConnection();
        $tableName = 'crud_post';
        if (!$setup->tableExists($tableName)) {
            $table = $connection->newTable(
                $setup->getTable($tableName)
            )
                ->addColumn(
                    'post_id', Table::TYPE_INTEGER, null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary' => true,
                    ], 'ID'
                )
                ->addColumn(
                    'category_id', Table::TYPE_INTEGER, null, ['nullable' => false],
                    'Category Id'
                )
                ->addColumn(
                    'is_active', Table::TYPE_SMALLINT, null, ['nullable' => false, 'default' => 1],
                    'Is Active'
                )
                ->addColumn(
                    'title', Table::TYPE_TEXT, 255, ['nullable' => false],
                    'Title'
                )
                ->addColumn(
                    'content', Table::TYPE_TEXT, '1M', ['nullable' => false],
                    'Content'
                )
                ->addColumn(
                    'views', Table::TYPE_SMALLINT, null, ['nullable' => false, 'default' => 0],
                    'Views'
                )
                ->addColumn(
                    'image', Table::TYPE_TEXT, 500, ['nullable' => true],
                    'Image'
                )
                ->addColumn(
                    'store_ids', Table::TYPE_TEXT, 255, ['nullable' => false, 'default' => "0"],
                    'Store Ids'
                )
                ->addColumn(
                    'publication_date',
                    Table::TYPE_DATETIME,
                    null,
                    ['nullable' => true],
                    'Publication Time'
                )
                ->addColumn(
                    'update_time',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
                    'Modification Time'
                )
                ->addIndex(
                    $setup->getIdxName(
                        $tableName,
                        ['title'],
                        AdapterInterface::INDEX_TYPE_UNIQUE
                    ),
                    ['title'],
                    ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
                )
                ->addForeignKey(
                    $setup->getFkName(
                        'crud_category', 'category_id', $tableName,
                        'category_id'
                    ),
                    'category_id',
                    $setup->getTable('crud_category'),
                    'category_id',
                    Table::ACTION_CASCADE
                )
                ->setComment('Post');
            $connection->createTable($table);

            $connection->addIndex($tableName,
                $setup->getIdxName(
                    $tableName,
                    ['title', 'image'],
                    AdapterInterface::INDEX_TYPE_FULLTEXT
                ), ['title', 'image'], AdapterInterface::INDEX_TYPE_FULLTEXT);
        }
    }

    /**
     * @param SchemaSetupInterface $setup
     */
    private function _createTagTable($setup)
    {
        $tableName = 'crud_tag';
        /** @var \Magento\Framework\DB\Adapter\AdapterInterface $connection */
        $connection = $setup->getConnection();
        if (!$setup->tableExists($tableName)) {
            $table = $connection->newTable(
                $setup->getTable($tableName)
            )
                ->addColumn(
                    'tag_id', Table::TYPE_INTEGER, null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary' => true,
                    ], 'ID'
                )
                ->addColumn(
                    'title', Table::TYPE_TEXT, 255, ['nullable' => false],
                    'Title'
                )
                ->addIndex(
                    $setup->getIdxName(
                        $tableName,
                        ['title'],
                        AdapterInterface::INDEX_TYPE_UNIQUE
                    ),
                    ['title'],
                    ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
                )
                ->setComment('Tag');
            $connection->createTable($table);
        }
    }

    /**
     * @param SchemaSetupInterface $setup
     */
    private function _createPostTagTable($setup)
    {
        $tableName = 'crud_post_tag';
        /** @var \Magento\Framework\DB\Adapter\AdapterInterface $connection */
        $connection = $setup->getConnection();
        if (!$setup->tableExists($tableName)) {
            $table = $connection->newTable(
                $setup->getTable($tableName)
            )
                ->addColumn(
                    'post_tag_id', Table::TYPE_INTEGER, null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary' => true,
                    ], 'ID'
                )
                ->addColumn(
                    'post_id', Table::TYPE_INTEGER, null, ['nullable' => false],
                    'Post id'
                )
                ->addColumn(
                    'tag_id', Table::TYPE_INTEGER, null, ['nullable' => false],
                    'Tag id'
                )
                ->addForeignKey(
                    $setup->getFkName(
                        'crud_post', 'post_id', $tableName,
                        'post_id'
                    ),
                    'post_id',
                    $setup->getTable('crud_post'),
                    'post_id',
                    Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $setup->getFkName(
                        'crud_tag', 'tag_id', $tableName,
                        'tag_id'
                    ),
                    'tag_id',
                    $setup->getTable('crud_tag'),
                    'tag_id',
                    Table::ACTION_CASCADE
                )
                ->setComment('Post Tag');
            $connection->createTable($table);
        }
    }
}