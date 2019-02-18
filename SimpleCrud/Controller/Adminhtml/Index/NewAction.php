<?php
namespace Magestudy\SimpleCrud\Controller\Adminhtml\Index;

use Magento\Cms\Controller\Adminhtml\Block;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;

class NewAction extends Block
{
    const ADMIN_RESOURCE = 'Magestudy_SimpleCrud::review';

    /**
     * @return ResponseInterface|ResultInterface|void
     */
    public function execute()
    {
        $this->_forward('edit');
    }
}
