<?php

namespace Magestudy\PaymentMethod\Block\Form;

use Magento\Framework\Exception\LocalizedException;
use Magento\Payment\Block\Form;
use Magento\Payment\Model\InfoInterface;

class ExamplePayment extends Form
{
    /**
     * @var string
     */
    protected $_template = 'Magestudy_PaymentMethod::form/example_form.phtml';

    /**
     * Retrieve info model
     *
     * @return InfoInterface
     * @throws LocalizedException
     */
    public function getInfo()
    {
        $info = $this->getData('info');
        if (!$info instanceof InfoInterface) {
            throw new LocalizedException(
                __('We cannot retrieve the payment info model object.')
            );
        }
        return $info;
    }
}
