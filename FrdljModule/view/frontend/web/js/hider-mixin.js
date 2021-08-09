define(['jquery'], function ($) {
    var widgetMixin = {
        hideElement: function () {  // функция, которую мы переопределяем
            this._hideMenu();
            this._super();
        },
        _hideMenu: function () {  // новая функция
            $('.sections.nav-sections').hide();
        }
    };
    return function (targetWidget) {
        $.widget('mynamespace.myfirstwidget', targetWidget, widgetMixin);
        return $.mynamespace.myfirstwidget;
    }
});

