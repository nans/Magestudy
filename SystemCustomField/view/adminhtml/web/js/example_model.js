define([
        'jquery',
        'ko',
        'jquery/ui'
    ], function ($, ko) {
        'use strict';
        return function (config) {
            var self = this;
            self.exampleValue = ko.observable(config.value);

            self.lastUpdate = ko.observable((config.last_update)?config.last_update:Date.now());

            self.exampleValue.subscribe(function () {
                self.lastUpdate(Date.now());
            });

            self.validateMessage = function () {
                if(self.exampleValue().length == 0){
                    return 'Not valid';
                }
                return 'Valid';
            };
        }
    }
);