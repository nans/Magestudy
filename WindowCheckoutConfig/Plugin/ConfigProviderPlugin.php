<?php

namespace Magestudy\WindowCheckoutConfig\Plugin;

use Magento\Tax\Model\TaxConfigProvider;

class ConfigProviderPlugin
{
    public function afterGetConfig(TaxConfigProvider $subject, $result)
    {
        $result['checkout_new_row'] = 'sample';

        return $result;
    }
}