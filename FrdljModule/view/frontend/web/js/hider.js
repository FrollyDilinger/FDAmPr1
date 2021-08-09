define(['jquery'], function ($) {
    $.widget('mynamespace.myfirstwidget', {
        options: {
            selector: null
        },
        _create: function () {
            this.hideElement();
        },
        hideElement: function () {
            $(this.options.selector).hide(); // selector автоматически попадает в опции
            $(this.element).hide();  // в this.element хранится селектор, на котором мы вызвали виджет в phtml
        }
    });
    return $.mynamespace.myfirstwidget;
});
