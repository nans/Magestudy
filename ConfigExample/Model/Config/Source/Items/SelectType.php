<?php

namespace Magestudy\ConfigExample\Model\Config\Source\Items;

use Magento\Framework\Option\ArrayInterface;

class SelectType implements ArrayInterface
{
    /**
     * Retrieve possible customer address types
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            0 => __('Billing Address'),
            1 => __('Shipping Address'),
            2 => __('Other Address')
        ];
    }
}