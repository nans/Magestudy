define([
    'jquery',
    'ko'
], function ($, ko) {
    'use strict';

    return function (data) {

        var model = {
            id: data.id,
            name: ko.observable(data.name),
            role: ko.observable(data.role),
            email: ko.observable(data.email),
            changes: ko.observable(0)
        };

        model.onValuesChange = function () {
            model.changes(model.changes() + 1);
        };

        model.name.subscribe(function () {
            model.onValuesChange();
        });

        model.email.subscribe(function () {
            model.onValuesChange();
        });

        return model;
    }
});