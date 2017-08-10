<?php

namespace Magestudy\Crud\Block\Adminhtml\Post;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;
use Magestudy\Crud\Block\Adminhtml\AbstractEdit;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\Post;

class Edit extends AbstractEdit
{
    /**
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $registry, $data);
    }

    /**
     * @return string
     */
    protected function _getDeleteAcl()
    {
        return AclResources::POST_DELETE;
    }

    /**
     * @return string
     */
    protected function _getSaveAcl()
    {
        return AclResources::POST_SAVE;
    }

    /**
     * @return string
     */
    protected function _getEntityTitle()
    {
        return Post::ENTITY_TITLE;
}

    /**
     * @param Post $model
     * @return string
     */
    protected function _getTitle($model)
    {
        return $model->getTitle();
    }

    /**
     * @return string
     */
    protected function _getController()
    {
        return 'post';
    }

    /**
     * @return string
     */
    protected function _getId()
    {
        return Post::ID;
    }
}