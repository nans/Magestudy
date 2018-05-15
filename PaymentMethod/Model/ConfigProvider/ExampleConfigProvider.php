<?php

namespace Magestudy\PaymentMethod\Model\ConfigProvider;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magestudy\PaymentMethod\Model\Payment\Example;

class ExampleConfigProvider implements ConfigProviderInterface
{
    const PAYMENT = 'payment';

    /**
     * @return array
     */
    public function getConfig()
    {
        return [self::PAYMENT => [Example::CODE => ['sample']]];
    }
}