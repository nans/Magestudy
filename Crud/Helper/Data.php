<?php

namespace Magestudy\Crud\Helper;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Model\Config\Source\Yesno;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Registry;
use Magento\Store\Model\System\Store;
use Magestudy\Crud\Model\ResourceModel\Category\Collection as CategoryCollection;
use Magestudy\Crud\Model\ResourceModel\Tag\Collection as TagCollection;

class Data
{
    const FRONTEND_ID = 'id';

    /**
     * Boolean options
     *
     * @var Yesno
     */
    protected $_booleanOptions;

    /**
     * @var Store
     */
    protected $_systemStore;

    /**
     * @var CategoryCollection
     */
    protected $_categoryCollection;

    /**
     * @var TagCollection
     */
    protected $_tagCollection;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Yesno $booleanOptions
     * @param Store $systemStore
     * @param CategoryCollection $categoryCollection
     * @param TagCollection $tagCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Yesno $booleanOptions,
        Store $systemStore,
        CategoryCollection $categoryCollection,
        TagCollection $tagCollection,
        array $data = []
    ) {
        $this->_booleanOptions = $booleanOptions;
        $this->_systemStore = $systemStore;
        $this->_categoryCollection = $categoryCollection;
        $this->_tagCollection = $tagCollection;
    }

    /**
     * @return CategoryCollection
     */
    public function getCategoryCollection()
    {
        return $this->_categoryCollection;
    }

    /**
     * @return TagCollection
     */
    public function getTagCollection()
    {
        return $this->_tagCollection;
    }

    /**
     * @return Store
     */
    public function getSystemStore()
    {
        return $this->_systemStore;
    }

    /**
     * @return Yesno
     */
    public function getBooleanOptions()
    {
        return $this->_booleanOptions;
    }
}