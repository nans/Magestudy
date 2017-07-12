<?php

namespace Magestudy\Crud\Ui\Component\Listing\Column\Post;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magestudy\Crud\Model\Category;
use Magestudy\Crud\Model\Post;
use Magestudy\Crud\Model\ResourceModel\Category\Collection;

class PostCategory extends Column
{
    /**
     * @var Collection
     */
    protected $_collection;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param Collection $collection
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        Collection $collection,
        array $components = [],
        array $data = []
    ) {
        $this->_collection = $collection;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        $allIds = $this->_collection->getAllIds();
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (!empty($item[Post::CATEGORY_ID]) && in_array($item[Post::CATEGORY_ID], $allIds)) {
                    /** @var Category $category */
                    $category = $this->_collection->getItemByColumnValue(Category::ID, $item[Post::CATEGORY_ID]);
                    $item[$this->getName()] = $category->getTitle();
                }
            }
        }
        return $dataSource;
    }
}