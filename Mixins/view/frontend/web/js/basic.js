define(
    [
        'jquery',
        'underscore',
        'ko',
        'uiComponent'
    ],
    function (
        $,
        _,
        ko,
        Component
    ) {
        'use strict';

        return Component.extend({
            method1: function () {
                return 'result from method1';
            },
            method2: function () {
                return 'result from method2';
            }
        });
    }
);