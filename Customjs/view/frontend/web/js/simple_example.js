define([
        'jquery',
        'ko',
        'user',
        'jquery/ui'
    ], function ($, ko, user) {
        'use strict';

        return function (config) {
            var self = this;
            self.baseUrlFromConfig = ko.observable(config.baseUrl);
            self.indexUrlFromConfig = ko.observable(config.indexUrl);
            self.changingVariable = ko.observable(0);
            self.allRecords = ko.observableArray([]);
            self.showDataForUser = true;
            self.users = ko.observableArray([]);

            self.isNeedToShow = function () {
                return true;
            };

            self.updateVariable = function () {
                self.changingVariable(self.changingVariable() + 1);
            };

            self.updateAllRecords = function () {
                for (var i = 0; i < config.exampleData.length; i++) {
                    self.allRecords.push({itemName: config.exampleData[i]});
                }
            };

            setInterval(self.updateVariable, 1000);

            self.updateAllRecords();

            self.setUserData = function () {
                for (var i = 0; i < config.userData.length; i++) {
                    self.users.push(new user(config.userData[i]));
                }
            };

            self.setUserData();
        }
    }
);