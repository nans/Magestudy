<?php

namespace Magestudy\WindowCheckoutConfig\Plugin\Block\Cart;

use Magento\Checkout\Block\Cart\Sidebar;

class SidebarPlugin
{
    public function afterGetConfig(Sidebar $subject, $result)
    {
        $result['checkout_window_new_row'] = 'sample2';

        return $result;
    }
}