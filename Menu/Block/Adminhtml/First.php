<?php
namespace Magestudy\Menu\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class First extends Container
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_first';
        $this->_blockGroup = 'Menu';
        $this->_headerText = __('Manage');
        parent::_construct();
    }
}