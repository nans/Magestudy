<?php

namespace Magestudy\Crud\Ui\Component\Listing\Column\Post;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Store\Model\System\Store;

class PostStoresFilterList implements OptionSourceInterface
{
    /**
     * @var array
     */
    protected $_options;

    /**
     * @var Store
     */
    protected $_systemStore;

    public function __construct(
        Store $systemStore
    ) {
        $this->_systemStore = $systemStore;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        if ($this->_options === null) {
            $this->_options = [];
            /** @var \Magento\Store\Model\Store $store */
            $stores = $this->_systemStore->getStoreCollection();
            foreach ($stores as $store) {
                $this->_options[] = [
                    'value' => $store->getId(),
                    'label' => $store->getName()
                ];
            }
        }
        return $this->_options;
    }
}