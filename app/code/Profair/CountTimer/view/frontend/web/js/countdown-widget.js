define([
    'jquery',
    'Profair_CountTimer/js/countdown-renderer',
    'Profair_CountTimer/js/jquery.countdown',
    'jquery/ui'
], function ($, countdownRenderer) {
    'use strict';

    $.widget('profair.countdown', {
        options: {
            startDate: "{}",
            dateAndTime: ""
        },

        /**
         * Creates widget instance.
         *
         * @return void
         */
        _create: function () {
            this._initCountdown();
        },

        _initCountdown: function () {
            var self = this;
            $(this.element).countdowntimer({
                startDate: self.options.startDate,
                dateAndTime: self.options.dateAndTime,
                size : "lg",
                regexpMatchFormat: "([0-9])([0-9]):([0-9])([0-9]):([0-9])([0-9]):([0-9])([0-9])",
                regexpReplaceWith: countdownRenderer.getCountdownTemplate()
            });
        }
    });

    return $.profair.countdown;
});