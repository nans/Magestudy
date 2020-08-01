<?php

namespace Magestudy\WidgetParameter\Block\Adminhtml\Widget\Type;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Data\Form\Element\Factory;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Data\Form\Element\Label;

class CustomField extends Template
{
    protected $elementFactory;

    /**
     * @param Context $context
     * @param Factory $elementFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        Factory $elementFactory, array $data = []
    ) {
        $this->elementFactory = $elementFactory;
        parent::__construct($context, $data);
    }

    /**
     * @param AbstractElement $element
     * @return AbstractElement
     */
    public function prepareElementHtml(AbstractElement $element)
    {
        $htmlId = $element->getId();
        $data = $element->getData();

        $data['after_element_js'] = $this->_afterElementJs($element);
        $data['after_element_html'] = $this->_afterElementHtml($element);
        $htmlItem = $this->elementFactory->create('text', ['data' => $data]);
        $htmlItem
            ->setId("{$htmlId}")
            ->setForm($element->getForm())
            ->addClass('required-entry')
            ->addClass('entities');
        $return = <<<HTML
                <div id="{$htmlId}-container">{$htmlItem->getElementHtml()}</div>
HTML;
        $element->setData('after_element_html', $return);

        return $element;
    }

    protected function _afterElementHtml($element)
    {
        return '<div><p>One line here: <span id="field_for_sample"></span></p></div>';
    }

    protected function _afterElementJs(Label $element)
    {
        return <<<HTML
            <script>
                    require([
                    'modifier',
                ], function (modifier) {
                        var config = {prefix:"pre_", postfix: "_post", id: "{$element->getHtmlId()}"};
                        var inputModifier = new modifier(config);
                        inputModifier.start();
                });
            </script>
HTML;
    }
}