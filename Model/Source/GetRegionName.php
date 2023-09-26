<?php

namespace Bluethinkinc\CityProvinceDropdown\Model\Source;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Directory\Model\ResourceModel\Region\CollectionFactory;

class GetRegionName implements OptionSourceInterface
{
    /**
     * @var CollectionFactory
     */
    private CollectionFactory $regionCollectionFactory;

    /**
     * @param CollectionFactory $regionCollectionFactory
     */
    public function __construct(
        CollectionFactory  $regionCollectionFactory
    ) {
        $this->regionCollectionFactory = $regionCollectionFactory;
    }

    /**
     * To option array holds options
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        $regions = $this->regionCollectionFactory->create();
        foreach ($regions as $region) {
            $option['label'] = $region->getDefaultName();
            $option['value'] = $region->getRegionId();
            $option['class'] = $region->getCountryId();
            $options[] = $option;
        }

        return $options ?? [];
    }
}
