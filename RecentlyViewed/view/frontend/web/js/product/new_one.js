define([
    'Magento_Ui/js/grid/columns/column',
    'Magento_Catalog/js/product/list/column-status-validator'
], function (Column, columnStatusValidator, $, stars) {
    'use strict';

    return Column.extend({
        /**
         * @returns {Boolean}
         */
        isAllowed: function () {
            return columnStatusValidator.isValid(this.source(), 'new_one', 'show_attributes');
        },

        /**
         * @param row
         * @returns {string}
         */
        getValue: function (row) {
            return row['extension_attributes']['new_one'];
        }
    });
});
