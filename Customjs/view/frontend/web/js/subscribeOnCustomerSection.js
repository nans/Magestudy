define([
    'jquery',
    'ko',
    'Magento_Customer/js/customer-data'
], function ($, ko, customerData) {
    'use strict';

    customerData.get('wishlist').subscribe(function () {
        console.log('Wish list data updated.')
    });

    return function () {}
});