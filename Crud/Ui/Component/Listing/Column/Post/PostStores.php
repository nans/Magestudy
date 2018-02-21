<?php

namespace Magestudy\Crud\Ui\Component\Listing\Column\Post;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Store\Model\System\Store;
use Magestudy\Crud\Api\Data\PostInterface;

class PostStores extends Column
{
    /**
     * @var Store
     */
    protected $_systemStore;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param Store $systemStore
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        Store $systemStore,
        array $components = [],
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
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
        /** @var \Magento\Store\Model\Store $store */
        $stores = $this->_systemStore->getStoreCollection();
        if (isset($dataSource['data']['items'])) {
            /** @var PostInterface $item */
            foreach ($dataSource['data']['items'] as &$item) {
                $ids = explode(",", $item[PostInterface::STORE_IDS]);
                $storesNames = [];
                if(in_array(0, $ids)){
                    $storesNames[] = __('All');
                }
                foreach ($stores as $store) {
                    if (in_array($store->getId(), $ids)) {
                        $storesNames[] = $store->getName();
                    }
                }
                $item[$this->getName()] = implode('; ', $storesNames) . ';';
            }
        }
        return $dataSource;
    }
}