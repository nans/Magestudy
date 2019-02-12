define(
    [
        'jquery',
        'underscore',
        'ko',
        'uiComponent',
        'uiRegistry',
    ],
    function (
        $,
        _,
        ko,
        Component,
        registry,
    ) {
        'use strict';

        var mixin = {
            method1: function() { return 'overridden result from method1 by mixin' },
            method3: function() { return 'added result from method3 by mixin' },
        };

        return function (target) {
            return target.extend(mixin);
        };

    }
);