<?php

namespace Magestudy\Page\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Page extends Template
{
    /**
     * Construct
     *
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

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