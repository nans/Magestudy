define([
        'jquery',
        'ko',
        'underscore'
    ], function ($, ko, _) {
        'use strict';

        return function (config) {
            var self = this;
            var mainField = $('#' + config.id);
            var additionalField = $('#field_for_sample');
            self.start = function () {
                mainField.change(function () {
                    additionalField.text(mainField.val());
                })
            };

            self.start();
        }
    }
);