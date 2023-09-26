<?php
declare(strict_types=1);

namespace Bluethinkinc\CityProvinceDropdown\Block\Adminhtml\City\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * Get button Data
     *
     * @return array
     */
    public function getButtonData(): array
    {
        return [
            'label' => __('Save City'),
            'class' => 'save primary hideSaveBtn',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}
