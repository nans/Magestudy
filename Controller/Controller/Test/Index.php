<?php

namespace Magestudy\Controller\Controller\Test;

use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * @return PageFactory
     */
    public function execute()
    {
        //index.php/controller/test/index or index.php/controller/test/
        echo 'Test controller; Index action;';
        die;
    }
}