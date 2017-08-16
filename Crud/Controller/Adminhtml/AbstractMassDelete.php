<?php

namespace Magestudy\Crud\Controller\Adminhtml;

abstract class AbstractMassDelete extends AbstractMassAction
{
    /**
     * @param Object $item
     * @return void
     */
    protected function _updateItem(&$item)
    {
        $this->_getRepository()->delete($item);
    }

    /**
     * @param int $collectionSize
     * @return string
     */
    protected function _getSuccessMessage($collectionSize)
    {
        return $this->messageManager->addSuccessMessage(
            __('A total of %1 ' . strtolower($this->_getEntityTitle()) . '(s) have been deleted.',
                $collectionSize));
    }
}