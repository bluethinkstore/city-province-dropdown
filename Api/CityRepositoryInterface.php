<?php
declare(strict_types=1);

namespace Bluethinkinc\CityProvinceDropdown\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface CityRepositoryInterface
{
    /**
     * Save City
     *
     * @param \Bluethinkinc\CityProvinceDropdown\Api\Data\CityInterface $city
     * @return \Bluethinkinc\CityProvinceDropdown\Api\Data\CityInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Bluethinkinc\CityProvinceDropdown\Api\Data\CityInterface $city
    );

    /**
     * Retrieve City
     *
     * @param string $cityId
     * @return \Bluethinkinc\CityProvinceDropdown\Api\Data\CityInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($cityId);

    /**
     * Retrieve City matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Bluethinkinc\CityProvinceDropdown\Api\Data\CitySearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete City
     *
     * @param \Bluethinkinc\CityProvinceDropdown\Api\Data\CityInterface $city
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Bluethinkinc\CityProvinceDropdown\Api\Data\CityInterface $city
    );

    /**
     * Delete City by ID
     *
     * @param string $cityId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($cityId);
}
