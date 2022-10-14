define([
    'jquery',
    'Magento_Catalog/product/view/validation',
    'ko'
], function ($, validation, ko) {
    "use strict";

    $.widget('profair.bookProduct', {

        options: {
            formContainer: '',
            mobilePhoneElement: '',
            productSku: ''
        },

        ajaxRequestProcessing: ko.observable(false),

        _create: function () {
            let self = this,
                elements = [self.options.formContainer];

            $(elements).each(function () {
                self._initForm($(this));
            });

            return false;
        },

        _initForm: function (element) {
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
                if (validator.valid() && !self.ajaxRequestProcessing()) {
                    self.ajaxRequestProcessing(true);
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
                self.ajaxRequestProcessing(false);
            });
        },

        confirm: function (response) {
            if (typeof response != "undefined" && typeof response.message != "undefined") {
                $(this.options.formContainer).find('.field').html(response.message);
            }
        }
    });

    return $.profair.bookProduct;
});