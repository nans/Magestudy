<?php

namespace Magestudy\Crud\Block\Adminhtml\Category\Edit;

use Magento\Backend\Block\Widget\Form\Generic;
use Magestudy\Crud\Model\Category;

class Form extends Generic
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('category_form');
        $this->setTitle(__(Category::ENTITY_TITLE . ' Information'));
    }

    /**
     * @return Form
     */
    protected function _prepareForm()
    {
        /** @var Category $model */
        $model = $this->_coreRegistry->registry(strtolower(Category::ENTITY_TITLE));

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

        $form->setHtmlIdPrefix(strtolower(Category::ENTITY_TITLE) . '_');
        $form->setUseContainer(true);

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        if ($model->getId()) {
            $fieldset->addField(Category::ID, 'hidden', ['name' => Category::ID]);
        }

        $fieldset->addField(
            Category::TITLE,
            'text',
            [
                'name' => Category::TITLE,
                'label' => __('Title'),
                'title' => __('Title'),
                'required' => true,
                'class' => 'validate-no-test-value'
            ]
        );

        $fieldset->addField(
            Category::DESCRIPTION,
            'text',
            [
                'name' => Category::DESCRIPTION,
                'label' => __('Description'),
                'title' => __('Description'),
                'required' => true,
                'class' => 'validate-no-html-tags'
            ]
        );

        $fieldset->addField(
            Category::IS_ACTIVE,
            'select',
            [
                'label' => __('Enabled'),
                'title' => __('Enabled'),
                'name' => Category::IS_ACTIVE,
                'required' => true,
                'values' => [Category::ENABLED_STATUS => __('Yes'), Category::DISABLED_STATUS => __('No')]
            ]
        );

        if ($model->getId()) {
            $fieldset->addField(
                Category::UPDATE_TIME,
                'label',
                ['label' => __('Last update'), 'title' => __('Last update')]
            );
        }

        $form->setValues($model->getData());
        $this->setForm($form);
        return $this;
    }
}