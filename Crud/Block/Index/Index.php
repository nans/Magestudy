<?php

namespace Magestudy\Crud\Block\Index;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magestudy\Crud\Model\ResourceModel\Post\Collection as PostCollection;
use Magestudy\Crud\Model\ResourceModel\Category\Collection as CategoryCollection;

class Index extends Template
{
    /**
     * @var PostCollection
     */
    private $_postCollection;

    /**
     * @var CategoryCollection
     */
    private $_categoryCollection;

    /**
     * Construct
     *
     * @param Context $context
     * @param PostCollection $postCollection
     * @param CategoryCollection $categoryCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        PostCollection $postCollection,
        CategoryCollection $categoryCollection,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_postCollection = $postCollection;
        $this->_categoryCollection = $categoryCollection;
    }

    /**
     * Simple example with not optimal code
     *
     * @return array
     */
    public function getPosts()
    {
        $this->_postCollection->addFilter('is_active', 1);
        $this->_categoryCollection->addFilter('is_active', 1);

        $posts = $this->_postCollection->getData();
        $categories = $this->_categoryCollection->getData();

        foreach ($posts as &$post) {
            $post['category'] = $this->_getCategoryById($categories, $post['category_id']);
        }
        return $posts;
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('Crud example'));
        $this->pageConfig->setDescription(__('Crud extension example'));
        $this->pageConfig->setKeywords(__('crud, extension, example'));
        return $this;
    }

    /**
     * @param array $categories
     * @param int $id
     * @return string
     */
    private function _getCategoryById(array $categories, $id)
    {
        foreach ($categories as $category) {
            if ($category['category_id'] == $id) {
                return $category['title'];
            }
        }
        return 'none';
    }
}