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
            self.totalChangesValue = ko.observable(0);
            self.firstValue = ko.observable(5);
            self.secondValue = ko.observable(1);

            self.sumOfValues = ko.pureComputed({
                read: function () {
                    return Number(self.firstValue()) + Number(self.secondValue());
                },
                write: function (value) {
                    value = Number(value);
                    if (value !== 0) {
                        self.firstValue(value / 2);
                        self.secondValue(value / 2);
                    } else {
                        self.firstValue(0);
                        self.secondValue(0);
                    }
                },
                owner: this
            });

            self.totalChanges = ko.computed(function () {
                self.baseUrlFromConfig();
                self.indexUrlFromConfig();
                self.allRecords();
                self.firstValue();
                self.secondValue();
                self.users();

                for (var i = 0; i < self.users().length; i++) {
                    self.users()[i].name();
                    self.users()[i].role();
                    self.users()[i].email();
                }

                self.totalChangesValue(self.totalChangesValue() + 1);
                return true;
            });

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