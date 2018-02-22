<?php

namespace Magestudy\Controller\Controller\Hello;

use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * @return PageFactory
     */
    public function execute()
    {
        //index.php/controller/hello/index or index.php/controller/hello/
        echo 'Hello controller; Index action;';
        die;
    }
}