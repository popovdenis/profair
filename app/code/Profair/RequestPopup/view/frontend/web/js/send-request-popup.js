define([
    'jquery',
    'Magento_Ui/js/modal/modal',
    'jquery/ui'
], function ($, modal) {
    'use strict';

    $.widget('profair.sendRequestPopup', {
        /**
         * Widget options.
         */
        options: {
            popupHolder: '',
            popupTitle: '',
            sendRequestForm: ''
        },

        /**
         * Creates widget instance.
         *
         * @return void
         */
        _create: function () {
            this._initPopupModal();
            this._addSendRequestHandler();
        },

        _initPopupModal: function () {
            let self = this,
                options = {
                    type: 'popup',
                    responsive: true,
                    innerScroll: true,
                    title: self.options.popupTitle,
                    buttons: [{
                        text: $.mage.__('Send Request'),
                        click: function (event) {
                            this.closeModal();
                            self._sendRequestEventHandler(event);
                        }
                    }, {
                        text: $.mage.__('Cancel'),
                        click: function () {
                            this.closeModal();
                        }
                    }]
                };

            modal(options, $(this.options.popupHolder));
        },

        _sendRequestEventHandler: function (event) {
            $(this.options.approvalWorkflowForm).trigger('submit');
        },

        /**
         * Adds click handler on the element.
         *
         * @return void
         */
        _addSendRequestHandler: function () {
            this.element.on('click', this._processSendRequestHandler.bind(this));
        },

        /**
         * Processes element click event.
         *
         * @return void
         */
        _processSendRequestHandler: function (event) {
            if (this.options.popupHolder.length === 0) {
                return;
            }

            $(this.options.popupHolder).modal('openModal');
        }
    });

    return $.profair.sendRequestPopup;
});