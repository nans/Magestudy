<?php

namespace Magestudy\Crud\Block\Adminhtml\Tag\Edit;

use Magento\Backend\Block\Widget\Form\Generic;
use Magestudy\Crud\Api\Data\TagInterface;
use Magestudy\Crud\Model\Tag;

class Form extends Generic
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('tag_form');
        $this->setTitle(__(Tag::ENTITY_TITLE . ' Information'));
    }

    /**
     * @return Form
     */
    protected function _prepareForm()
    {
        /** @var TagInterface $model */
        $model = $this->_coreRegistry->registry(strtolower(Tag::ENTITY_TITLE));

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

        $form->setHtmlIdPrefix(strtolower(Tag::ENTITY_TITLE) . '_');
        $form->setUseContainer(true);

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        if ($model->getId()) {
            $fieldset->addField(Tag::ID, 'hidden', ['name' => Tag::ID]);
        }

        $fieldset->addField(
            Tag::TITLE,
            'text',
            ['name' => Tag::TITLE, 'label' => __('Title'), 'title' => __('Title'), 'required' => true]
        );

        $form->setValues($model->getData());
        $this->setForm($form);
        return $this;
    }
}