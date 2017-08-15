<?php

namespace Magestudy\Crud\Setup;

use Magento\Framework\Setup\UninstallInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class Uninstall implements UninstallInterface
{
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {

        $setup->startSetup();

        $setup->getConnection()->dropForeignKey('crud_post', $setup->getFkName(
            'crud_category', 'category_id', 'crud_post',
            'category_id'
        ));

        $setup->getConnection()->dropForeignKey('crud_post_tag', $setup->getFkName(
            'crud_post', 'post_id', 'crud_post_tag',
            'post_id'
        ));

        $setup->getConnection()->dropForeignKey('crud_post_tag', $setup->getFkName(
            'crud_tag', 'tag_id', 'crud_post_tag',
            'tag_id'
        ));

        if ($setup->tableExists('crud_category')) {
            $setup->getConnection()->dropTable('crud_category');
        }

        if ($setup->tableExists('crud_post')) {
            $setup->getConnection()->dropTable('crud_post');
        }

        $setup->endSetup();
    }
}