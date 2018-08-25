<?php

namespace Magestudy\HideCustomerMenuItem\Block\Frontend;

use Magento\Framework\View\Element\Html\Link\Current;

class CustomerLink extends Current
{
    /**
     * Show/hide link by condition
     *
     * @return string
     */
    public function toHtml()
    {
        if (!$this->someCondition()) {
            return '';//hide
        }

        return parent::toHtml();//show
    }

    /**
     * @return bool
     */
    private function someCondition()
    {
        return true; //set false to hide menu item
    }
}