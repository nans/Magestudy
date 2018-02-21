<?php

namespace Magestudy\Crud\Block\Adminhtml\Tag\Edit;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Framework\Model\AbstractModel;
use Magestudy\Crud\Api\Data\TagInterface;
use Magento\Framework\Data\Form as DataForm;

/**
 * @method setId(string $id)
 * @method setTitle(string $title)
 */

class Form extends Generic
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('tag_form');
        $this->setTitle(__(TagInterface::ENTITY_TITLE . ' Information'));
    }

    /**
     * @return Form
     */
    protected function _prepareForm()
    {
        /** @var TagInterface|AbstractModel $model */
        $model = $this->_coreRegistry->registry(strtolower(TagInterface::ENTITY_TITLE));

        /** @var DataForm $form */
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'edit_form',
                    'action' => $this->getData('action'),
                    'method' => 'post'
                ]
            ]
        );

        $form->setHtmlIdPrefix(strtolower(TagInterface::ENTITY_TITLE) . '_');
        $form->setUseContainer(true);

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        if ($model->getId()) {
            $fieldset->addField(TagInterface::ID, 'hidden', ['name' => TagInterface::ID]);
        }

        $fieldset->addField(
            TagInterface::TITLE,
            'text',
            ['name' => TagInterface::TITLE, 'label' => __('Title'), 'title' => __('Title'), 'required' => true]
        );

        $form->setValues($model->getData());
        $this->setForm($form);
        return $this;
    }
}