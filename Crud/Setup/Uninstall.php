<?php

namespace Magestudy\Crud\Setup;

use Magento\Framework\Setup\UninstallInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magestudy\Crud\Model\Category;
use Magestudy\Crud\Model\ResourceModel\Category as CategoryResource;
use Magestudy\Crud\Model\Post;
use Magestudy\Crud\Model\ResourceModel\Post as PostResource;

class Uninstall implements UninstallInterface
{
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {

        $setup->startSetup();

        $setup->getConnection()->dropForeignKey(PostResource::MAIN_TABLE, $setup->getFkName(
            CategoryResource::MAIN_TABLE, Category::ID, PostResource::MAIN_TABLE,
            Post::CATEGORY_ID
        ));

        if ($setup->tableExists(CategoryResource::MAIN_TABLE)) {
            $setup->getConnection()->dropTable(CategoryResource::MAIN_TABLE);
        }
        if ($setup->tableExists(PostResource::MAIN_TABLE)) {
            $setup->getConnection()->dropTable(PostResource::MAIN_TABLE);
        }

        $setup->endSetup();
    }
}