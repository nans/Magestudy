<?php

namespace Magestudy\Controller\Controller\Test;

use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;

class Check extends Action
{
    /**
     * @return PageFactory
     */
    public function execute()
    {
        //index.php/controller/test/check
        echo 'Test controller; Check action;';
        die;
    }
}