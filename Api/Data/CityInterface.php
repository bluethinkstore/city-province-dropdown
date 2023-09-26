<?php
declare(strict_types=1);

namespace Bluethinkinc\CityProvinceDropdown\Api\Data;

interface CityInterface
{
    public const CITY_ID = 'city_id';
    public const CITY_NAME = 'city_name';
    public const REGION_ID = 'region_id';

    /**
     * Get city_id
     *
     * @return string|null
     */
    public function getCityId();

    /**
     * Set city_id
     *
     * @param string $cityId
     * @return \Bluethinkinc\CityProvinceDropdown\City\Api\Data\CityInterface
     */
    public function setCityId($cityId);

    /**
     * Get region_id
     *
     * @return string|null
     */
    public function getRegionId();

    /**
     * Set region_id
     *
     * @param string $regionId
     * @return \Bluethinkinc\CityProvinceDropdown\City\Api\Data\CityInterface
     */
    public function setRegionId($regionId);

    /**
     * Get city_name
     *
     * @return string|null
     */
    public function getCityName();

    /**
     * Set city_name
     *
     * @param string $cityName
     * @return \Bluethinkinc\CityProvinceDropdown\City\Api\Data\CityInterface
     */
    public function setCityName($cityName);
}
