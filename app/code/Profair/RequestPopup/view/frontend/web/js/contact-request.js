define([
    'jquery',
    'Magento_Catalog/product/view/validation',
    'ko',
    'mage/url'
], function ($, validation, ko, url) {
    "use strict";

    $.widget('profair.contactRequest', {

        options: {
            contactRequestForm: '#contact-request-form'
        },

        ajaxCartProcessing: ko.observable(false),

        _create: function () {
            let self = this,
                elements = [self.options.contactRequestForm];

            $(elements).each(function () {
                self._initCartForm($(this));
            });

            return false;
        },

        _initCartForm: function (element) {
            if (typeof element === 'undefined') {
                return;
            }

            let self = this;

            element.unbind('submit');
            element.on('submit', function (e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                e.stopPropagation();

                let validator = $(this).validation();
                if (validator.valid() && !self.ajaxCartProcessing()) {
                    self.ajaxCartProcessing(true);
                    self.ajaxSubmit($(this));
                }

                return false;
            });
        },

        ajaxSubmit: function (form) {
            let self = this,
                data = form.serialize();

            $.ajax({
                url: form.attr('action'),
                data: data,
                type: 'post',
                dataType: 'json',
                showLoader: true,
                success: function (response) {
                    self.confirm(response);
                }
            }).always(function () {
                self.ajaxCartProcessing(false);
            });
        },

        confirm: function (params) {

        }
    });

    return $.profair.contactRequest;
});