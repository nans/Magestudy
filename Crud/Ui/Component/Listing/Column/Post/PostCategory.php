<?php

namespace Magestudy\Crud\Ui\Component\Listing\Column\Post;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magestudy\Crud\Api\Data\CategoryInterface;
use Magestudy\Crud\Api\Data\PostInterface;
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
                if (!empty($item[PostInterface::CATEGORY_ID]) && in_array($item[PostInterface::CATEGORY_ID], $allIds)) {
                    /** @var CategoryInterface $category */
                    $category = $this->_collection->getItemByColumnValue(
                        CategoryInterface::ID,
                        $item[PostInterface::CATEGORY_ID]
                    );
                    $item[$this->getName()] = $category->getTitle();
                }
            }
        }
        return $dataSource;
    }
}