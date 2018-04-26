<?php

namespace Magestudy\CustomerAccountTab\Block\Frontend;

use Magento\Framework\View\Element\Template;

class Example extends Template
{
    /**
     * @return string
     */
    public function getExampleText(): string
    {
        return 'Some example text';
    }
}