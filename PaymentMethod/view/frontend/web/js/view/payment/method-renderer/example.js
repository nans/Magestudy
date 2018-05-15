define(['Magento_Checkout/js/view/payment/default'],
    function (Component) {
        'use strict';

        return Component.extend({
            defaults: {
                template: 'Magestudy_PaymentMethod/payment/example-form'
            },
            context: function () {
                return this;
            },

            getCode: function () {
                return 'example';
            },

            isActive: function () {
                return true;
            },

            getSampleData: function () {
                return window.checkoutConfig.payment.example[0];
            }
        });
    }
);