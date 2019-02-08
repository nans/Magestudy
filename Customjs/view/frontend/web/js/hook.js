define([], function(){
    'use strict';
    console.log("Called hook.");

    return function(targetModule){
        return targetModule;
    };
});

