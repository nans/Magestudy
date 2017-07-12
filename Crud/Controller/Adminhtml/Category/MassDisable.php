<?php

namespace Magestudy\Crud\Controller\Adminhtml\Category;

use Magestudy\Crud\Api\Data\CategoryInterface;
use Magestudy\Crud\Model\Category;

class MassDisable extends MassEnable
{
    /**
     * @override
     * @param CategoryInterface $item
     * @return void
     */
    protected function _updateItem(&$item)
    {
        $item->setIsActive(Category::DISABLED_STATUS);
    }

    /**
     * @override
     * @param int $collectionSize
     * @return string
     */
    protected function _getSuccessMessage($collectionSize)
    {
        return __('A total of %1 record(s) have been disabled.', $collectionSize);
    }
}