<?php

namespace Magestudy\Crud\Controller\Adminhtml;

use Magento\Backend\App\Action;

abstract class AbstractAction extends Action
{
    /**
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed($this->_getAclResource());
    }

    /**
     * @return string
     */
    abstract protected function _getAclResource();

    /**
     * @return string
     */
    abstract protected function _getEntityTitle();

    /**
     * @return string
     */
    abstract protected function _getRepositoryInterface();
}