<?php

namespace Zazmic\Shopify\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use \Magento\Framework\DB\Adapter\AdapterInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.5', '<')) {
            $this->createCronJobTable($setup);
        }

        if (version_compare($context->getVersion(), '1.0.6', '<')) {
            $this->addUpdateTimeColumn($setup);
        }

        if (version_compare($context->getVersion(), '1.0.7', '<')) {
            $this->updateCronJobItemsLength($setup, 'items', 'Items');
            $this->updateCronJobItemsLength($setup, 'result', 'Result');
        }

        if (version_compare($context->getVersion(), '1.0.8', '<')) {
            $this->createLoosedConnectionTable($setup);
        }

        if (version_compare($context->getVersion(), '1.0.9', '<')) {
            $this->createOrdersStatsTable($setup);
        }

        if (version_compare($context->getVersion(), '1.0.10', '<')) {
            $this->createShopifyOrderTable($setup);
        }

        if (version_compare($context->getVersion(), '1.0.11', '<')) {
            $this->createBanTable($setup);
        }

        if (version_compare($context->getVersion(), '1.0.12', '<')) {
            $setup->getConnection()->addForeignKey($setup->getFkName('shopify_connection', 'product_id', 'catalog_product_entity', 'entity_id'), 'shopify_connection', 'product_id', $setup->getTable('catalog_product_entity'), 'entity_id', \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE);
        }

        if (version_compare($context->getVersion(), '1.0.13', '<')) {
            $this->addVariantsColumn($setup);
        }

        if (version_compare($context->getVersion(), '1.0.14', '<')) {
            $this->addSellerColumnToBrokenOrder($setup);
        }

        if (version_compare($context->getVersion(), '1.0.15', '<')) {
            $this->addCreateTimeColumn($setup);
        }

        if (version_compare($context->getVersion(), '1.0.16', '<')) {
            $this->addPriorityColumn($setup);
        }

        $setup->endSetup();
    }

    /**
     * Create table for cron jobs
     *
     * @param SchemaSetupInterface $setup
     * @throws \Zend_Db_Exception
     */
    private function createCronJobTable(SchemaSetupInterface $setup)
    {
        $tableName = 'shopify_cron_job';

        if ($setup->tableExists($tableName)) {
            return;
        }

        $table = $setup->getConnection()->newTable($setup->getTable($tableName))
            ->addColumn(
                'id',
                Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'nullable' => false,
                    'primary'  => true,
                    'unsigned' => true,
                ], 'ID'
            )
            ->addColumn(
                'customer_id',
                Table::TYPE_INTEGER,
                null,
                ['nullable' => false, 'unsigned' => true],
                'Customer ID')
            ->addColumn(
                'status',
                Table::TYPE_TEXT,
                25,
                ['nullable' => false],
                'Status')
            ->addColumn(
                'job',
                Table::TYPE_TEXT,
                25,
                ['nullable' => false],
                'Job')
            ->addColumn(
                'items',
                Table::TYPE_TEXT,
                null,
                ['nullable' => false],
                'Items')
            ->addColumn(
                'result',
                Table::TYPE_TEXT,
                null,
                ['nullable' => false],
                'Items')
            ->setComment('Shopify cron job');

        $setup->getConnection()->createTable($table);
    }

    /**
     * Add column with modification time
     *
     * @param SchemaSetupInterface $setup
     */
    private function addUpdateTimeColumn(SchemaSetupInterface $setup)
    {
        $connection = $setup->getConnection();

        $definition = [
            'type'     => Table::TYPE_TIMESTAMP,
            'length'   => null,
            'nullable' => false,
            'default'  => Table::TIMESTAMP_INIT_UPDATE,
            'comment'  => 'Modification Time',
        ];

        $connection->addColumn('shopify_cron_job', 'updated_at', $definition);
    }

    /**
     * Change text field to longtext
     *
     * @param SchemaSetupInterface $setup
     * @param string $column
     * @param string $comment
     */
    private function updateCronJobItemsLength(SchemaSetupInterface $setup, string $column, string $comment)
    {
        $table = 'shopify_cron_job';

        $definition = [
            'type'     => Table::TYPE_TEXT,
            'length'   => Table::MAX_TEXT_SIZE,
            'nullable' => false,
            'comment'  => $comment,
        ];
        $setup->getConnection()->changeColumn($table, $column, $column, $definition);
    }

    /**
     * Create table for reconnected products
     *
     * @param SchemaSetupInterface $setup
     * @throws \Zend_Db_Exception
     */
    protected function createLoosedConnectionTable(SchemaSetupInterface $setup)
    {
        $tableName = 'shopify_connection';

        if ($setup->tableExists($tableName)) {
            return;
        }

        $table = $setup->getConnection()->newTable($setup->getTable($tableName));

        $table->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            [
                'identity' => true,
                'nullable' => false,
                'primary'  => true,
                'unsigned' => true,
            ], 'ID'
        );

        $table->addColumn(
            'product_id',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false, 'unsigned' => true],
            'Product ID'
        );

        $table->addColumn('created_at', Table::TYPE_TIMESTAMP, null, ['default' => Table::TIMESTAMP_INIT]);

        $table->addColumn('updated_at', Table::TYPE_TIMESTAMP, null, ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE]);

        $table->addColumn(
            'message',
            Table::TYPE_TEXT,
            Table::MAX_TEXT_SIZE,
            ['nullable' => true],
            'Message'
        );

        $table->addColumn(
            'details',
            Table::TYPE_TEXT,
            Table::MAX_TEXT_SIZE,
            ['nullable' => true],
            'Details'
        );

        $table->setComment('Not reconnected products');

        $setup->getConnection()->createTable($table);
    }

    /**
     * Added table for save stats about not send orders
     *
     * @param SchemaSetupInterface $setup
     * @throws \Zend_Db_Exception
     */
    private function createOrdersStatsTable(SchemaSetupInterface $setup)
    {
        $tableName = 'shopify_order';

        if ($setup->tableExists($tableName)) {
            return;
        }

        $table = $setup->getConnection()->newTable($setup->getTable($tableName));

        $table->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            [
                'identity' => true,
                'nullable' => false,
                'primary'  => true,
                'unsigned' => true,
            ], 'ID'
        );

        $table->addColumn(
            'order_id',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false, 'unsigned' => true],
            'Order ID'
        );

        $table->addColumn('created_at', Table::TYPE_TIMESTAMP, null, ['default' => Table::TIMESTAMP_INIT]);

        $table->addColumn('updated_at', Table::TYPE_TIMESTAMP, null, ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE]);

        $table->addColumn(
            'message',
            Table::TYPE_TEXT,
            3000,
            ['nullable' => true],
            'Message'
        );

        $table->addColumn(
            'details',
            Table::TYPE_TEXT,
            200000,
            ['nullable' => true],
            'Details'
        );

        $table->setComment('Not sended orders');

        $setup->getConnection()->createTable($table);
    }

    private function createShopifyOrderTable(SchemaSetupInterface $setup)
    {
        $tableName = 'shopify_orders';

        $table = $setup->getConnection()->newTable($setup->getTable($tableName));

        $table->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            [
                'identity' => true,
                'nullable' => false,
                'primary'  => true,
                'unsigned' => true,
            ], 'ID'
        );

        $table->addColumn(
            'order_id',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false, 'unsigned' => true],
            'Order ID'
        );

        $table->addColumn('created_at', Table::TYPE_TIMESTAMP, null, ['default' => Table::TIMESTAMP_INIT]);

        $table->addColumn('updated_at', Table::TYPE_TIMESTAMP, null, ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE]);

        $table->addColumn(
            'shopify_id',
            Table::TYPE_TEXT,
            50,
            ['nullable' => false],
            'Shopify ID'
        );

        $table->addColumn(
            'tracking_number',
            Table::TYPE_TEXT,
            250,
            ['nullable' => true],
            'Tracking numbers'
        );

        $table->addColumn(
            'fulfilment_status',
            Table::TYPE_INTEGER,
            null,
            [
                'nullable' => false,
                'unsigned' => true,
            ], 'Fulfilment status'
        );

        $table->addColumn(
            'status',
            Table::TYPE_INTEGER,
            null,
            [
                'nullable' => false,
                'unsigned' => true,
            ], 'Status'
        );

        $table->addColumn(
            'seller_id',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false, 'unsigned' => true],
            'Seller ID'
        );

        $table->setComment('Shopify Orders');

        $setup->getConnection()->createTable($table);

        $this->addIndex($setup, 'seller_id', $tableName);
        $this->addIndex($setup, 'order_id', $tableName);
        $this->addIndex($setup, 'shopify_id', $tableName);
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param string $column
     * @param string $table
     */
    protected function addIndex(SchemaSetupInterface $setup, string $column, string $table)
    {
        $setup->getConnection()
            ->addIndex(
                $table,
                $setup->getIdxName(
                    $table,
                    [$column],
                    AdapterInterface::INDEX_TYPE_INDEX
                ),
                [$column],
                AdapterInterface::INDEX_TYPE_INDEX
            );
    }

    /**
     * Ban product for reconnection
     *
     * @param SchemaSetupInterface $setup
     * @throws \Zend_Db_Exception
     */
    private function createBanTable(SchemaSetupInterface $setup)
    {
        $tableName = 'banned_reconnection';

        $table = $setup->getConnection()->newTable($setup->getTable($tableName));

        $table->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            [
                'identity' => true,
                'nullable' => false,
                'primary'  => true,
                'unsigned' => true,
            ], 'ID'
        );

        $table->addColumn(
            'product_id',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false, 'unsigned' => true],
            'Product ID'
        );

        $table->addColumn(
            'shopify_id',
            Table::TYPE_TEXT,
            100,
            ['nullable' => true],
            'Shopify ID'
        );

        $table->addColumn('created_at', Table::TYPE_TIMESTAMP, null, ['default' => Table::TIMESTAMP_INIT]);

        $table->addColumn(
            'admin_id',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false],
            'Admin ID'
        );

        $table->addForeignKey(
            $setup->getFkName($tableName, 'product_id', 'catalog_product_entity', 'entity_id'),
            'product_id', $setup->getTable('catalog_product_entity'),
            'entity_id', \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE);

        $table->setComment('Banned Reconnection');

        $setup->getConnection()->createTable($table);

        $this->addIndex($setup, 'product_id', $tableName);
        $this->addIndex($setup, 'shopify_id', $tableName);
    }

    private function addVariantsColumn(SchemaSetupInterface $setup)
    {
        $connection = $setup->getConnection();

        $definition = [
            'type'     => Table::TYPE_TEXT,
            'length'   => 250,
            'nullable' => true,
            'comment'  => 'Variant IDs',
        ];

        $connection->addColumn('shopify_connection', 'variants', $definition);
    }

    /**
     * @param SchemaSetupInterface $setup
     */
    private function addSellerColumnToBrokenOrder(SchemaSetupInterface $setup)
    {
        $connection = $setup->getConnection();

        $definition = [
            'type'     => Table::TYPE_INTEGER,
            'length'   => null,
            'nullable' => true,
            'unsigned' => true,
            'comment'  => 'Seller ID'
        ];

        $connection->addColumn('shopify_order', 'seller_id', $definition);
    }

    /**
     * Add column with creation time
     *
     * @param SchemaSetupInterface $setup
     */
    private function addCreateTimeColumn(SchemaSetupInterface $setup)
    {
        $connection = $setup->getConnection();

        $definition = [
            'type'     => Table::TYPE_TIMESTAMP,
            'length'   => null,
            'nullable' => false,
            'default'  => Table::TIMESTAMP_INIT,
            'comment'  => 'Creation Time',
        ];

        $connection->addColumn('shopify_cron_job', 'created_at', $definition);
    }

    /**
     * Add job priority column
     *
     * @param SchemaSetupInterface $setup
     */
    private function addPriorityColumn(SchemaSetupInterface $setup)
    {
        $connection = $setup->getConnection();

        $definition = [
            'type'     => Table::TYPE_SMALLINT,
            'length'   => null,
            'nullable' => false,
            'unsigned' => true,
            'default'  => 2,
            'comment'  => 'Priority',
        ];

        $connection->addColumn('shopify_cron_job', 'priority', $definition);
    }
}
