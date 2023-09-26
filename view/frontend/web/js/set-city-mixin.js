define([
        'jquery',
        'mage/utils/wrapper',
        'mage/validation',
        'mage/url',
        'Magento_Checkout/js/model/url-builder',
        'mage/storage'
    ],
    function ($, wrapper, validation,url,urlBuilder,storage) {

        'use strict';
        $(document).on('change', '[name="region_id"]', function() {
            const regionCode = $('[name="region_id"]').val();
            const value = (regionCode !== undefined) ? regionCode : 'UP';
            let urlRestApi = urlBuilder.createUrl('/bluethinkinc_province_dropdown/geturlrepositoryinterface', {});
            let payload = {
                value: value
            };
            storage.post(
                urlRestApi,
                JSON.stringify(payload)
            ).done(function (response) {
                let data = JSON.parse(response);
                 $("[name='city']").empty();
                 if(data.value=='')
                 {
                     $("[name='shippingAddress.city']").css('display', 'none');
                     // $("[name='shippingAddressCity']").css('display', 'none');
                     $("[name='customCheckoutForm.cityInput']").css('display', 'block');
                 }
                 else
                 {
                     $("[name='shippingAddress.city']").css('display', 'block');
                     // $("[name='cityInput']").css('display', 'none');
                     $("[name='customCheckoutForm.cityInput']").css('display', 'none');
                     let htmlSelect;
                     htmlSelect = '<option selected="disabled">Please select a city</option>';
                     $.each(data.value, function (index, value) {
                         let options = '<option value="' + value.city_id + '">' + value.city_name + '</option>';
                         htmlSelect += options;
                     });
                     $("[name='city']").append(htmlSelect);
                 }
                 });
            });

        return function (setShippingInformationAction) {
            return wrapper.wrap(setShippingInformationAction, function (originalAction) {
                return originalAction();
            });
        }
    });
