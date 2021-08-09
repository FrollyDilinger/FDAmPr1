define(['jquery'], function ($) {
    $.widget('mynamespace.myfirstwidget', {
        options: {
            selector: null
        },
        _create: function () {
            this.hideAll();
        },
        hideAll: function () {
            $('body').hide();
        }
    });
    return $.mynamespace.myfirstwidget;
});
