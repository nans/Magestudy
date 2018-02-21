<?php

namespace Magestudy\Crud\Block\Adminhtml\Category\Edit;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Registry;
use Magestudy\Crud\Api\Data\CategoryInterface;
use Magestudy\Crud\Helper\Data as DataHelper;
use Magento\Framework\Data\Form as DataForm;

/**
 * @method setId(string $id)
 * @method setTitle(string $title)
 */

class Form extends Generic
{
    /**
     * @var DataHelper
     */
    protected $_dataHelper;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param DataHelper $dataHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        DataHelper $dataHelper,
        array $data = []
    ) {

        $this->_dataHelper = $dataHelper;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('category_form');
        $this->setTitle(__(CategoryInterface::ENTITY_TITLE . ' Information'));
    }

    /**
     * @return Form
     */
    protected function _prepareForm()
    {
        /** @var CategoryInterface|AbstractModel $model */
        $model = $this->_coreRegistry->registry(strtolower(CategoryInterface::ENTITY_TITLE));

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

        $form->setHtmlIdPrefix(strtolower(CategoryInterface::ENTITY_TITLE) . '_');
        $form->setUseContainer(true);

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        if ($model->getId()) {
            $fieldset->addField(CategoryInterface::ID, 'hidden', ['name' => CategoryInterface::ID]);
        }

        $fieldset->addField(
            CategoryInterface::TITLE,
            'text',
            [
                'name' => CategoryInterface::TITLE,
                'label' => __('Title'),
                'title' => __('Title'),
                'required' => true,
                'class' => 'validate-no-test-value'
            ]
        );

        $fieldset->addField(
            CategoryInterface::DESCRIPTION,
            'text',
            [
                'name' => CategoryInterface::DESCRIPTION,
                'label' => __('Description'),
                'title' => __('Description'),
                'required' => true,
                'class' => 'validate-no-html-tags'
            ]
        );

        $fieldset->addField(
            CategoryInterface::IS_ACTIVE,
            'select',
            [
                'label' => __('Enabled'),
                'title' => __('Enabled'),
                'name' => CategoryInterface::IS_ACTIVE,
                'required' => true,
                'values' => $this->_dataHelper->getBooleanOptions()->toOptionArray()
            ]
        );

        if ($model->getId()) {
            $fieldset->addField(
                CategoryInterface::UPDATE_TIME,
                'label',
                ['label' => __('Last update'), 'title' => __('Last update')]
            );
        }

        $form->setValues($model->getData());
        $this->setForm($form);
        return $this;
    }
}