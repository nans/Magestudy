<?php

namespace Magestudy\Crud\Block\Adminhtml;

use Magento\Backend\Block\Widget\Form\Container;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Phrase;
use Magento\Framework\Registry;

abstract class AbstractEdit extends Container
{
    /**
     * @var Registry
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
     * @return Phrase
     */
    public function getHeaderText()
    {
        /** @var Object $model */
        $model = $this->_coreRegistry->registry(strtolower($this->_getEntityTitle()));
        if ($model->getId()) {
            return __("Edit " . $this->_getEntityTitle() . " '%1'", $this->escapeHtml($this->_getTitle($model)));
        } else {
            return __('New ' . $this->_getEntityTitle());
        }
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = $this->_getId();
        $this->_blockGroup = 'Magestudy_Crud';
        $this->_controller = 'adminhtml_' . $this->_getController();
        parent::_construct();
        $this->_addButtons();
    }

    protected function _addButtons()
    {
        if ($this->_isAllowedAction($this->_getSaveAcl())) {
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

        if ($this->_isAllowedAction($this->_getDeleteAcl())) {
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
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('*/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }

    /**
     * @return string
     */
    abstract protected function _getDeleteAcl();

    /**
     * @return string
     */
    abstract protected function _getSaveAcl();

    /**
     * @return string
     */
    abstract protected function _getEntityTitle();

    /**
     * @param Object $model
     * @return string
     */
    abstract protected function _getTitle($model);

    /**
     * @return string
     */
    abstract protected function _getController();

    /**
     * @return string
     */
    abstract protected function _getId();
}