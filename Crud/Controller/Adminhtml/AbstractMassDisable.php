<?php

namespace Magestudy\Crud\Controller\Adminhtml;

use Magestudy\Crud\Api\Data\StatusSwitchInterface;

abstract class AbstractMassDisable extends AbstractMassAction
{
    /**
     * @param int $collectionSize
     * @return string
     */
    protected function _getSuccessMessage($collectionSize)
    {
        return __('A total of %1 '.strtolower($this->_getEntityTitle()).'(s) have been disabled.', $collectionSize);
    }

    /**
     * @param StatusSwitchInterface|Object $item
     * @return void
     */
    protected function _updateItem(&$item)
    {
        $item->deactivate();
        $this->_getRepository()->save($item);
    }
}