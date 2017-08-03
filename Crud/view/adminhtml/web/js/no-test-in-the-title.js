require([
    'jquery',
    'Magento_Ui/js/modal/confirm',
    'jquery/ui',
    'jquery/validate',
    'mage/translate'
], function($){
    $.validator.addMethod(
        'validate-no-test-value', function (value) {
            return value !== 'Test';
        }, $.mage.__('Test value is not supported.'));
});