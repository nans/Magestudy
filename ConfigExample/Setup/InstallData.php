<?php

namespace Magestudy\ConfigExample\Setup;

use Magento\Config\Model\ResourceModel\Config;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallData implements InstallDataInterface
{
    /**
     * @var Config
     */
    protected $_resourceConfig;

    /**
     * @param Config $resourceConfig
     */
    public function __construct(
        Config $resourceConfig
    ) {
        $this->_resourceConfig = $resourceConfig;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     *
     * @return void
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $this->_resourceConfig->saveConfig(
            'magestudy/global/text_item',
            'test data',
            'default',
            0
        );
        $this->_resourceConfig->saveConfig(
            'magestudy/first_group/select_item',
            1,
            'default',
            0
        );

        $this->_resourceConfig->saveConfig(
            'magestudy_2/global/text_item',
            'text',
            'default',
            0
        );
    }
}