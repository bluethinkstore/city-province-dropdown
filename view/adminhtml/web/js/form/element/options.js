define([
    'jquery',
    'Magento_Ui/js/form/element/select',
    'Magento_Ui/js/modal/modal',
    'mage/storage',
    'mage/url',
    'mage/adminhtml/form'
], function ($, Select, modal, storage, url,form) {
    'use strict';
    return Select.extend({
        onUpdate: function(value){
            url.setBaseUrl(window.origin);
            $.ajax({
                showLoader: true,
                url: url.build('/admin/bluethinkinc_cityprovincedropdown/index/getStateData'),
                data: {form_key: window.FORM_KEY, value:value},
                type: "POST",
                dataType: 'json'
            }).done(function (data) {
                $('[name="region_id"]').empty();
                if(data.value=='')
                {
                    $('[name="region_id"]').css('display', 'none');
                    $('.hideCityName').css('display', 'none');
                    $('.hideSaveBtn').css('display', 'none');
                    $('.hideSaveAndContinueBtn').css('display', 'none');
                }
                else
                {
                    $('[name="region_id"]').css('display', 'block');
                    $('.hideCityName').css('display', 'block');
                    $('.hideSaveBtn').css('display', 'block');
                    $('.hideSaveAndContinueBtn').css('display', 'block');

                    let htmlSelect;
                    htmlSelect = '<option selected="disabled">Please select a region, state or province.</option>';
                    $.each(data.value, function (index, value) {
                        let options = '<option value="' + value.region_id + '">' + value.name + '</option>';
                        htmlSelect += options;
                    });
                    $('[name="region_id"]').append(htmlSelect);
                }
            });
            return this._super();
        },
    });
});
