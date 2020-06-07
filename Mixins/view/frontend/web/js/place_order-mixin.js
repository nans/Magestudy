define(['mage/utils/wrapper', 'jquery'], function (wrapper, $) {
    'use strict';

    return function (placeOrderAction) {
        return wrapper.wrap(placeOrderAction, function (originalAction, paymentData, redirectOnSuccess) {
            console.log('Some js logic before place order');
            return originalAction(paymentData, redirectOnSuccess);
        });
    };
});