<?php

namespace Magestudy\Page\Block;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Page extends Template implements IdentityInterface
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
     * Return identifiers for produced content
     *
     * @return array
     */
    public function getIdentities()
    {
        return ['test' . '_' . 'list'];
    }

    /**
     * @return string
     */
    public function getLittleBitOfData()
    {
        return 'Little bit of data from block;';
    }
}