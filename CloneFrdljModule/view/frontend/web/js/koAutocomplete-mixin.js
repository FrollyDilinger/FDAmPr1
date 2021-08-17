define(['uiComponent', 'jquery', 'mage/url'], function (Component, $, urlBuilder) {
    'use strict';
    var mixin = {
        handleAutocomplete: function (searchValue) {
            if (searchValue.length >= 5) {
                $.getJSON(this.searchUrl, {
                    sku: searchValue
                }, function (data) {
                    this.searchResult(data)
                }.bind(this))
            } else {
                this.searchResult([])
            }
        },
    };

    return function (target) {
        return target.extend(mixin);
    };
});