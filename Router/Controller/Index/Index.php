<?php

namespace Magestudy\Router\Controller\Index;

use Magento\Framework\App\Action\Action;

class Index extends Action
{
    public function execute()
    {
        $params = $this->getRequest()->getParams();
        var_dump($params);
        echo '<b>Custom router sample;</b>';
        die;
    }
}