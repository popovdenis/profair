define([
    'Profair_CountTimer/js/view/countdown-template',
    'mage/template',
    'mage/mage'
], function (countdownTemplate, mageTemplate) {
    return {
        /**
         * Provide rendered countdown view.
         *
         * @return {null|*}
         */
        getCountdownTemplate: function () {
            return countdownTemplate();
        }
    };
});