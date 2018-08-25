<?php

namespace Magestudy\ProductEditButton\Block\Adminhtml\Edit\Button;

use Magento\Catalog\Block\Adminhtml\Product\Edit\Button\Generic;

class Example extends Generic
{
    /**
     * Shop button if product have shopify data to go to page with information
     *
     * @return array
     */
    public function getButtonData()
    {
        $product = $this->getProduct();

        if (!$product->getId()) {//hide for new products
            return [];
        }

        return [
            'label'      => __('Example'),
            'on_click'   => sprintf("location.href = '%s';", 'https://github.com/nans/Magestudy'),
            'sort_order' => 2,
        ];
    }
}