define(['uiComponent', 'jquery', 'mage/url'], function (Component, $, urlBuilder) {
    return Component.extend({
        searchText: '',
        searchResult: [],
        searchUrl: urlBuilder.build('standark/search/autocomplete'),
        initObservable: function () {
            this._super();
            this.observe(['searchText', 'searchResult'])
            return this;
        },
        initialize: function () {
            this._super();
            this.searchText.subscribe(this.handleAutocomplete.bind(this))
        },
        handleAutocomplete: function (searchValue) {
            if (searchValue.length >= 3) {
                $.getJSON(this.searchUrl, {
                    sku: searchValue
                }, function (data) {
                    this.searchResult(data)
                }.bind(this))
            } else {
                this.searchResult([])
            }
        },
    })
})
