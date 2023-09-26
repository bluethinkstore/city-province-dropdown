<?php
declare(strict_types=1);

namespace Bluethinkinc\CityProvinceDropdown\Model;

use Bluethinkinc\CityProvinceDropdown\Api\Data\CityInterface;
use Magento\Framework\Model\AbstractModel;

class City extends AbstractModel implements CityInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Bluethinkinc\CityProvinceDropdown\Model\ResourceModel\City::class);
    }

    /**
     * @inheritDoc
     */
    public function getCityId()
    {
        return $this->getData(self::CITY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCityId($cityId)
    {
        return $this->setData(self::CITY_ID, $cityId);
    }

    /**
     * @inheritDoc
     */
    public function getRegionId()
    {
        return $this->getData(self::REGION_ID);
    }

    /**
     * @inheritDoc
     */
    public function setRegionId($regionId)
    {
        return $this->setData(self::REGION_ID, $regionId);
    }

    /**
     * @inheritDoc
     */
    public function getCityName()
    {
        return $this->getData(self::CITY_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setCityName($cityName)
    {
        return $this->setData(self::CITY_NAME, $cityName);
    }
}
