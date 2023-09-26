<?php

namespace Bluethinkinc\CityProvinceDropdown\Plugin\Block\Checkout;

use Magento\Directory\Model\ResourceModel\Country\CollectionFactory;

class LayoutProcessor
{

    /**
     * After process
     *
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $result
     * @return array
     */
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        $result
    ): array {

        //For shipping form
        $result['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['city'] = [
            'component' => 'Magento_Ui/js/form/element/select',
            'config' => [
                'customScope' => 'shippingAddress',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/select',
                'id' => 'drop-down',
            ],
            'dataScope' => 'shippingAddress.city',
            'label' => __('City'),
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => [],
            'sortOrder' => 70,
            'id' => 'drop-down',
            'options' => $this->getCitiesDropdown()
        ];
        //Adding input field
        $result['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['cityInput'] = [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => 'customCheckoutForm',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/input',
            ],
            'provider' => 'checkoutProvider',
            'dataScope' => 'customCheckoutForm.cityInput',
            'label' => 'City',
            'sortOrder' => 70,
            'id' => 'cityInput',
            'validation' => [
                'required-entry' => true,
            ],
        ];

        //For Billing Form
        foreach ($result['components']['checkout']['children']['steps']['children']['billing-step']['children']
                 ['payment']['children']['payments-list']['children'] as $key => $payment) {
            if (isset($payment['children']['form-fields']['children']['city'])) {
                $result['components']['checkout']['children']['steps']['children']['billing-step']['children']
                ['payment']['children']['payments-list']['children'][$key]['children']['form-fields']['children']
                ['city'] = [
                    'component' => 'Magento_Ui/js/form/element/select',
                    'config' => [
                        'customScope' => 'shippingAddress',
                        'template' => 'ui/form/field',
                        'elementTmpl' => 'ui/form/element/select',
                        'id' => 'dropDown',
                    ],
                    'label' => __('City'),
                    'provider' => 'checkoutProvider',
                    'visible' => true,
                    'validation' => [],
                    'sortOrder' => 70,
                    'id' => 'drop-down',
                    'options' => $this->getCitiesDropdown()
                ];
            } elseif (isset($payment['children']['form-fields']['children']['cityInput'])) {
                $result['components']['checkout']['children']['steps']['children']['billing-step']['children']
                ['payment']['children']['payments-list']['children'][$key]['children']['form-fields']['children']
                ['cityInput'] = [
                    'component' => 'Magento_Ui/js/form/element/abstract',
                    'config' => [
                        'customScope' => 'customCheckoutForm',
                        'template' => 'ui/form/field',
                        'elementTmpl' => 'ui/form/element/input',
                    ],
                    'provider' => 'checkoutProvider',
                    'dataScope' => 'customCheckoutForm.cityInput',
                    'label' => 'City',
                    'sortOrder' => 70,
                    'id' => 'cityInput',
                    'validation' => [
                        'required-entry' => true,
                    ],
                    ];
            }
        }

        return $result;
    }

    /**
     * Get cities dropdown
     *
     * @return array[]
     */
    public function getCitiesDropdown(): array
    {
        return [
            ['value' => "test1", "label" => "Please select a city", "is_default" => true]
        ];
    }
}
