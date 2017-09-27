<?php

namespace Magestudy\PluginExample\Console\Command;

use Magento\Framework\App\ObjectManager;
use Magestudy\PluginExample\Model\Product;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetProductCommand extends Command
{
    protected function configure()
    {
        $this->setName('magestudy:get_product')->setDescription('Get product information');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Product $product */
        $product = ObjectManager::getInstance()->get(Product::class);
        $output->writeln($product->toString());
    }
}