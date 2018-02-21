<?php

namespace Magestudy\Crud\Ui\Component\Listing\Column\Category;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magestudy\Crud\Api\Data\CategoryInterface;
use Magestudy\Crud\Api\Data\StatusSwitchInterface;

class Title extends Column
{
    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            /** @var StatusSwitchInterface $item */
            foreach ($dataSource['data']['items'] as &$item) {
                if ($item[CategoryInterface::IS_ACTIVE] == CategoryInterface::DISABLED_STATUS) {
                    $item['fieldClass']['*'] = ['category-disabled' => true];
                }
            }
        }
        return $dataSource;
    }
}