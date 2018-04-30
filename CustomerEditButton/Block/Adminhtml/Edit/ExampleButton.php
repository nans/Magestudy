<?php

namespace Magestudy\CustomerEditButton\Block\Adminhtml\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\AuthorizationInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Customer\Block\Adminhtml\Edit\GenericButton;

class ExampleButton extends GenericButton implements ButtonProviderInterface
{
    /** @var AuthorizationInterface */
    private $authorization;

    /**
     * @param Context $context
     * @param Registry $registry
     */
    public function __construct(
        Context $context,
        Registry $registry
    ) {
        $this->authorization = $context->getAuthorization();
        parent::__construct($context, $registry);
    }

    /**
     * @return array
     */
    public function getButtonData()
    {
        if (!$this->getCustomerId() && $this->authorization->isAllowed('Magestudy_CustomerEditButton::example_action')) {
            return []; //button don't show
        }

        return [
            'label' => __('Example'),
            'id' => 'example_button_id',
            'class' => 'add',
            'sort_order' => 10,
            //'on_click' => 'location.reload();',
            //'on_click' => sprintf("location.href = '%s';", $this->getSomeUrl()),
            //'data_attribute' => ['mage-init' => ['button' => ['event' => 'someEvent']], 'form-role' => 'someRole'],
        ];
    }

    /**
     * @return string
     */
    protected function getSomeUrl()
    {
        return $this->getUrl('customer/index/index');
    }
}






