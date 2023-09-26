define([
    'jquery',
    'mage/utils/wrapper',
    'mage/template',
    'mage/validation',
    'mage/url',
    'mage/cookies'
], function ($,wrapper,template,validation,url) {
    'use strict';
    return function () {
        url.setBaseUrl(window.origin);
        $(document).on('change','#region_id',function() {
            if(document.getElementById('states')){
                document.getElementById('states').value = '';
            }
            if(document.getElementById('state')){
                document.getElementById('state').value = '';
            }
            const value = $('[name="region_id"]').val();
            $.ajax({
                showLoader: true,
                url: url.build('/bluethinkinc_province_dropdown/city/getCityData'),
                data: {form_key: $.mage.cookies.get('form_key'),value:value},
                type: "POST",
                dataType: 'json'
            }).done(function (data) {
                $('#city_id').empty();
                if(data.value=='')
                {
                    $('#city_id').css('display', 'none');
                    $('#city').css('display', 'block');
                }
                else
                {
                    $('#city_id').css('display', 'block');
                    $('#city').css('display','none');

                    let htmlSelect;
                    htmlSelect = '<option selected="disabled">Please select a city</option>';
                        $.each(data.value, function (index, value) {
                            let options = '<option value="' + value.city_id + '">' + value.city_name + '</option>';
                            htmlSelect += options;
                        });
                    $('#city_id').append(htmlSelect);
                }
            });
        });
    };
});
