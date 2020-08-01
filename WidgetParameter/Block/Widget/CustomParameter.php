<?php

namespace Magestudy\WidgetParameter\Block\Widget;

use Magento\Widget\Block\BlockInterface;
use Magento\Framework\View\Element\Template;

class CustomParameter extends Template implements BlockInterface
{
    protected $_template = 'Magestudy_WidgetParameter::widget/view.phtml';

    /**
     * @inheritDoc
     */
    public function addData(array $arr)
    {

    }

    /**
     * @inheritDoc
     */
    public function setData($key, $value = null)
    {

    }
}