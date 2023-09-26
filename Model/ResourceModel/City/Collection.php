<?php
declare(strict_types=1);

namespace Bluethinkinc\CityProvinceDropdown\Model\ResourceModel\City;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'city_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Bluethinkinc\CityProvinceDropdown\Model\City::class,
            \Bluethinkinc\CityProvinceDropdown\Model\ResourceModel\City::class
        );
    }
}
