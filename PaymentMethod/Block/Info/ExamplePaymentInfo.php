<?php

namespace Magestudy\PaymentMethod\Block\Info;

use Magento\Framework\Exception\LocalizedException;
use Magento\Payment\Block\Info;
use Magento\Payment\Model\InfoInterface;

class ExamplePaymentInfo extends Info
{
    /**
     * @var string
     */
    protected $_template = 'Magestudy_PaymentMethod::info/example_info.phtml';

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

    /**
     * @return string
     */
    public function someDataFromBlock()
    {
        return 'Text from block';
    }
}
