define([
    'jquery',
    'ko',
    'underscore'
], function ($, ko, _) {
    'use strict';

    var mixin = {
        /**
         * Update mini shopping cart content.
         *
         * @param {Object} updatedCart
         * @returns void
         */
        update: function (updatedCart) {
            console.log('Minicart update mixin');
            this._super(updatedCart);
        },
    };

    return function (Component) {
        return Component.extend(mixin);
    }
});
