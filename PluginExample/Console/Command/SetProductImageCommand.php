<?php

namespace Magestudy\PluginExample\Console\Command;

use Magento\Framework\App\ObjectManager;
use Magestudy\PluginExample\Model\Product;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SetProductImageCommand extends Command
{
    protected function configure()
    {
        $this->setName('magestudy:set_product_image')->setDescription('Set product image');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Product $product */
        $product = ObjectManager::getInstance()->get(Product::class);
        $product->addImage("http://some.url", rand(6, 60));
        $output->writeln($product->toString());
    }
}