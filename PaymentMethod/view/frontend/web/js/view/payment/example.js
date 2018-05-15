define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (Component, rendererList) {
        'use strict';

        rendererList.push(
            {
                type: 'example',
                component: 'Magestudy_PaymentMethod/js/view/payment/method-renderer/example'
            }
        );

        return Component.extend({});
    }
);