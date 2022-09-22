define([
    'jquery',
    'Profair_RequestPopup/js/countdown-renderer',
    'Profair_RequestPopup/js/jquery.countdown',
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
// 			regexpReplaceWith: "$1 days $2 hours $3 minutes $4 seconds REMAINING"
                regexpReplaceWith: countdownRenderer.getCountdownTemplate()
                //"$1<sup>days</sup> / $2<sup>hours</sup> / $3<sup>minutes</sup> / $4<sup>seconds</sup>"
            });
        }
    });

    return $.profair.countdown;
});