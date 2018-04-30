<?php

namespace Magestudy\Crud\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magestudy\Crud\Api\Data\CategoryInterface;
use Magestudy\Crud\Api\Data\PostInterface;
use Magestudy\Crud\Model\ResourceModel\Category;
use Magestudy\Crud\Model\ResourceModel\Post;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * Upgrades data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ){
        $setup->startSetup();

        $connection = $setup->getConnection();

        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $categoryTable = $connection->getTableName(Category::getTableName());
            $postTable = $connection->getTableName(Post::getTableName());

            $connection->insert($categoryTable,
                [
                    CategoryInterface::IS_ACTIVE => 1,
                    CategoryInterface::TITLE => 'First category',
                    CategoryInterface::DESCRIPTION => 'First category description'
                ]);

            $category = $connection->fetchRow($connection->select()->from($categoryTable));
            if ($category && $category[PostInterface::CATEGORY_ID]) {
                $connection->insert($postTable,
                    [
                        PostInterface::IS_ACTIVE => 1,
                        PostInterface::TITLE => 'First post',
                        PostInterface::CONTENT => 'Post text.',
                        PostInterface::CATEGORY_ID => $category[PostInterface::CATEGORY_ID]
                    ]);
            }
        }
        
        $setup->endSetup();
    }
}