<?php

namespace Magestudy\CustomerEditTab\Block\Adminhtml\Edit\Tab;

use Magento\Backend\Block\Template\Context;
use Magento\Customer\Controller\RegistryConstants;
use Magento\Framework\Data\Form;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Phrase;
use Magento\Framework\Registry;
use Magento\Ui\Component\Layout\Tabs\TabInterface;
use Magento\Backend\Block\Widget\Form\Generic;

class ExampleForm extends Generic implements TabInterface
{
    const FORM_PREFIX = 'example';
    const FIELD_TEXT = 'text_field';

    /**
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * ExampleForm constructor.
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return string|null
     */
    public function getCustomerId()
    {
        return $this->coreRegistry->registry(RegistryConstants::CURRENT_CUSTOMER_ID);
    }

    /**
     * @return Phrase
     */
    public function getTabLabel()
    {
        return __('Example tab');
    }

    /**
     * @return Phrase
     */
    public function getTabTitle()
    {
        return __('Example tab');
    }

    /**
     * @return bool
     */
    public function canShowTab()
    {
        if ($this->getCustomerId()) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isHidden()
    {
        if ($this->getCustomerId()) {
            return false;
        }
        return true;
    }

    /**
     * Tab class getter
     *
     * @return string
     */
    public function getTabClass()
    {
        return '';
    }

    /**
     * Return URL link to Tab content
     *
     * @return string
     */
    public function getTabUrl()
    {
        return '';
    }

    /**
     * Tab should be loaded trough Ajax call
     *
     * @return bool
     */
    public function isAjaxLoaded()
    {
        return false;
    }

    public function _prepareForm()
    {
        if (!$this->canShowTab()) {
            return $this;
        }

        /**@var Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix(self::FORM_PREFIX . '_');

        $fieldset = $form->addFieldset('example__form', ['legend' => __('Example tab')]);

        $fieldset->addField(self::FIELD_TEXT, 'text', array(
            'label' => __('Text'),
            'title' => __('Text'),
            'name' => self::FORM_PREFIX . '[' . self::FIELD_TEXT . ']',
            'data-form-part' => $this->getData('target_form'),
            'maxlength' => 255
        ));

        $this->setForm($form);
        return parent::_prepareForm();
    }
}