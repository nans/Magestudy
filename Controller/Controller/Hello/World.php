<?php

namespace Magestudy\Controller\Controller\Hello;

use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;

class World extends Action
{
    /**
     * @return PageFactory
     */
    public function execute()
    {
        //index.php/controller/hello/world
        echo 'Hello controller; World action;';
        die;
    }
}