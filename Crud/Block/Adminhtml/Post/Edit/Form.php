<?php

namespace Magestudy\Crud\Block\Adminhtml\Post\Edit;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Registry;
use Magestudy\Crud\Helper\Data as DataHelper;
use Magestudy\Crud\Api\Data\PostInterface;
use Magento\Framework\Data\Form as DataForm;

/**
 * @method setId(string $id)
 * @method setTitle(string $title)
 */

class Form extends Generic
{
    /**
     * @var Config
     */
    protected $_wysiwygConfig;

    /**
     * @var DataHelper
     */
    protected $_dataHelper;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Config $wysiwygConfig
     * @param DataHelper $dataHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        DataHelper $dataHelper,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_dataHelper = $dataHelper;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('post_form');
        $this->setTitle(__(PostInterface::ENTITY_TITLE . ' Information'));
    }

    /**
     * @return Form
     */
    protected function _prepareForm()
    {
        /** @var PostInterface|AbstractModel $model */
        $model = $this->_coreRegistry->registry(strtolower(PostInterface::ENTITY_TITLE));

        /** @var DataForm $form */
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'edit_form',
                    'action' => $this->getData('action'),
                    'method' => 'post',
                    'enctype' => 'multipart/form-data'
                ]
            ]
        );

        $form->setHtmlIdPrefix(strtolower(PostInterface::ENTITY_TITLE) . '_');
        $form->setUseContainer(true);

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        if ($model->getId()) {
            $fieldset->addField(PostInterface::ID, 'hidden', ['name' => PostInterface::ID]);
        }

        $fieldset->addField(
            PostInterface::TITLE,
            'text',
            ['name' => PostInterface::TITLE, 'label' => __('Title'), 'title' => __('Title'), 'required' => true]
        );

        $fieldset->addField(
            PostInterface::CONTENT,
            'editor',
            [
                'name' => PostInterface::CONTENT,
                'label' => __('Content'),
                'title' => __('Content'),
                'required' => true,
                'rows' => '5',
                'cols' => '30',
                'wysiwyg' => true,
                'config' => $this->_wysiwygConfig->getConfig()
            ]
        );

        $fieldset->addField(
            PostInterface::CATEGORY_ID,
            'select',
            [
                'label' => __('Category'),
                'title' => __('Category'),
                'name' => PostInterface::CATEGORY_ID,
                'required' => true,
                'values' => $this->_dataHelper->getCategoryCollection()->toOptionArray()
            ]
        );

        $fieldset->addField(
            PostInterface::IS_ACTIVE,
            'select',
            [
                'name' => PostInterface::IS_ACTIVE,
                'label' => __('Enabled'),
                'title' => __('Enabled'),
                'required' => true,
                'values' => $this->_dataHelper->getBooleanOptions()->toOptionArray(),
            ]
        );

        $fieldset->addField(
            PostInterface::STORE_IDS,
            'multiselect',
            [
                'name' => PostInterface::STORE_IDS,
                'label' => __('Store Views'),
                'title' => __('Store Views'),
                'note' => __('Select Store Views'),
                'required' => true,
                'values' => $this->_dataHelper->getSystemStore()->getStoreValuesForForm(
                    false, true
                ),
            ]
        );

        $fieldset->addField(
            PostInterface::VIEWS,
            'text',
            [
                'name' => PostInterface::VIEWS,
                'label' => __('Views'),
                'title' => __('Views'),
                'required' => false,
                'class' => 'validate-zero-or-greater'
            ]
        );

        $fieldset->addField(
            PostInterface::IMAGE,
            'image',
            [
                'name' => PostInterface::IMAGE,
                'label' => __('Image'),
                'title' => __('Image'),
                'required' => false
            ]
        );

        $fieldset->addField(
            PostInterface::PUBLICATION_DATE,
            'date',
            [
                'name' => PostInterface::PUBLICATION_DATE,
                'label' => __('Publication date'),
                'date_format' => 'yyyy-MM-dd',
                'time_format' => 'hh:mm:ss',
                'required' => false
            ]
        );

        $fieldset->addField(
            PostInterface::TAG,
            'multiselect',
            [
                'name' => PostInterface::TAG,
                'label' => __('Tags'),
                'title' => __('Tags'),
                'note' => __('Select Tags'),
                'required' => false,
                'values' => $this->_dataHelper->getTagCollection()->toOptionArray(),
            ]
        );

        $form->setValues($model->getData());
        $this->setForm($form);
        return $this;
    }
}