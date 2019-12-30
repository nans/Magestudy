<?php

namespace Magestudy\Page\Controller\Test;

use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Page\Config;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class Index extends Action
{
    /**
     * Execute view action
     * @url index.php/page/test/
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var ResultInterface|Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        /** @var Config $config */
        $config = $resultPage->getConfig();
        $config->getTitle()->set('sample title');
        $config->setDescription('sample description');
        $config->setKeywords('sample keywords');

        return $resultPage;
    }
}