<?php

namespace Magestudy\Crud\Block\Adminhtml\Tag;

use Magento\Backend\Block\Widget\Form\Container;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;
use Magestudy\Crud\Helper\AclResources;
use Magestudy\Crud\Model\Tag;

class Edit extends Container
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

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
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }


    /**
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        /** @var Tag $model */
        $model = $this->_coreRegistry->registry(strtolower(Tag::ENTITY_TITLE));
        if ($model->getId()) {
            return __("Edit " . Tag::ENTITY_TITLE . " '%1'", $this->escapeHtml($model->getTitle()));
        } else {
            return __('New ' . Tag::ENTITY_TITLE);
        }
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = Tag::ID;
        $this->_blockGroup = 'Magestudy_Crud';
        $this->_controller = 'adminhtml_tag';

        parent::_construct();

        if ($this->_isAllowedAction(AclResources::TAG_SAVE)) {
            $this->buttonList->update('save', 'label', __('Save'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => [
                                'event' => 'saveAndContinueEdit',
                                'target' => '#edit_form'
                            ],
                        ],
                    ]
                ],
                -100
            );
        } else {
            $this->buttonList->remove('save');
        }

        if ($this->_isAllowedAction(AclResources::TAG_DELETE)) {
            $this->buttonList->update('delete', 'label', __('Delete'));
        } else {
            $this->buttonList->remove('delete');
        }
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    /**
     * Getter of url for "Save and Continue" button
     * tab_id will be replaced by desired by JS later
     *
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('*/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }
}