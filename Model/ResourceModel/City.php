<?php
declare(strict_types=1);

namespace Bluethinkinc\CityProvinceDropdown\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class City extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('bluethinkinc_cityprovincedropdown_city', 'city_id');
    }
}
