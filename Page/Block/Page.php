<?php

namespace Magestudy\Page\Block;

use Magento\Framework\View\Element\Template;

class Page extends Template
{
    /**
     * @return string
     */
    public function getLittleBitOfData()
    {
        return 'Little bit of data from block;';
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('Custom page title'));
        $this->pageConfig->setDescription(__('Custom page description'));
        $this->pageConfig->setKeywords(__('Custom, page, keywords'));
        //$this->pageConfig->setRobots();
        return $this;
    }
}