<?php

namespace Magestudy\Menu\Block\Adminhtml;
use Magento\Backend\Block\Widget\Grid\Container;

class Second extends Container
{
    /**
     * @return void
     */
    protected function _construct()
    {
      /*  $this->_blockGroup = 'PHPCuong_Faq';
        $this->_controller = 'Adminhtml_Faq';
        $this->_headerText = __('FAQs Manager');
        $this->_addButtonLabel = __('Add New FAQ');*/
        parent::_construct();
    }
}