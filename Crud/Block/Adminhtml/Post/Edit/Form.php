<?php

namespace Magestudy\Crud\Block\Adminhtml\Post\Edit;

use Magento\Backend\Block\Widget\Form\Generic;
use Magestudy\Crud\Model\Post;
use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Backend\Block\Template\Context;
use Magento\Config\Model\Config\Source\Yesno;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Registry;
use Magento\Store\Model\System\Store;
use Magestudy\Crud\Model\ResourceModel\Category\Collection as CategoryCollection;

class Form extends Generic
{
    /**
     * @var Config
     */
    protected $_wysiwygConfig;

    /**
     * Boolean options
     *
     * @var Yesno
     */
    protected $_booleanOptions;

    /**
     * @var Store
     */
    protected $_systemStore;

    /**
     * @var CategoryCollection
     */
    protected $_categoryCollection;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Yesno $booleanOptions
     * @param Store $systemStore
     * @param Config $wysiwygConfig
     * @param CategoryCollection $collection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Yesno $booleanOptions,
        Store $systemStore,
        Config $wysiwygConfig,
        CategoryCollection $collection,
        array $data = []
    ) {
        $this->_booleanOptions = $booleanOptions;
        $this->_systemStore = $systemStore;
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_categoryCollection = $collection;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('post_form');
        $this->setTitle(__(Post::ENTITY_TITLE . ' Information'));
    }

    /**
     * @return Form
     */
    protected function _prepareForm()
    {
        /** @var Post $model */
        $model = $this->_coreRegistry->registry(strtolower(Post::ENTITY_TITLE));

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'edit_form',
                    'action' => $this->getData('action'),
                    'method' => 'post'
                ]
            ]
        );

        $form->setHtmlIdPrefix(strtolower(Post::ENTITY_TITLE) . '_');
        $form->setUseContainer(true);

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        if ($model->getId()) {
            $fieldset->addField(Post::ID, 'hidden', ['name' => Post::ID]);
        }

        $fieldset->addField(
            Post::TITLE,
            'text',
            ['name' => Post::TITLE, 'label' => __('Title'), 'title' => __('Title'), 'required' => true]
        );

        $fieldset->addField(
            Post::CONTENT,
            'editor',
            [
                'name' => Post::CONTENT,
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
            Post::CATEGORY_ID,
            'select',
            [
                'label' => __('Category'),
                'title' => __('Category'),
                'name' => Post::CATEGORY_ID,
                'required' => true,
                'values' => $this->_categoryCollection->toOptionArray()
            ]
        );

        $fieldset->addField(
            Post::IS_ACTIVE,
            'select',
            [
                'name' => Post::IS_ACTIVE,
                'label' => __('Enabled'),
                'title' => __('Enabled'),
                'required' => true,
                'values' => $this->_booleanOptions->toOptionArray(),
            ]
        );

        $fieldset->addField(
            Post::STORE_IDS,
            'multiselect',
            [
                'name' => Post::STORE_IDS,
                'label' => __('Store Views'),
                'title' => __('Store Views'),
                'note' => __('Select Store Views'),
                'required' => true,
                'values' => $this->_systemStore->getStoreValuesForForm(
                    false, true
                ),
            ]
        );

        $fieldset->addField(
            Post::VIEWS,
            'text',
            ['name' => Post::VIEWS, 'label' => __('Views'), 'title' => __('Views'), 'required' => false]
        );

        $fieldset->addField(
            Post::IMAGE,
            'text',
            ['name' => Post::IMAGE, 'label' => __('Image'), 'title' => __('Image'), 'required' => false]
        );

        $fieldset->addField(
            Post::PUBLICATION_DATE,
            'date',
            [
                'name' => Post::PUBLICATION_DATE,
                'label' => __('Publication date'),
                'date_format' => 'yyyy-MM-dd',
                'time_format' => 'hh:mm:ss',
                'required' => false
            ]
        );

        $form->setValues($model->getData());
        $this->setForm($form);
        return $this;
    }
}