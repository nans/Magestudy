<?php

namespace Magestudy\PluginExample\Console\Command;

use Magento\Framework\App\ObjectManager;
use Magestudy\PluginExample\Model\Product;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SetProductPriceCommand extends Command
{
    protected function configure()
    {
        $this->setName('magestudy:set_product_price')->setDescription('Set product price');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Product $product */
        $product = ObjectManager::getInstance()->get(Product::class);
        $price = rand(100, 999999);
        $product->setPrice($price);
        $output->writeln('Original price: ' . $price . "\n" . 'Real price: ' . $product->getPrice());
    }
}