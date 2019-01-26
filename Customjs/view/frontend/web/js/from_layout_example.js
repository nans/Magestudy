define([
        'jquery',
        'ko'
    ], function ($, ko) {
        'use strict';

        return function (config) {
            var self = this;

            console.log(config);

            self.getFirstValue = function () {
                return config.first;
            };

            self.getSecondValue = function () {
                return config.second;
            };
        }
    }
);