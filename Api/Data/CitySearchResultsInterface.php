<?php
declare(strict_types=1);

namespace Bluethinkinc\CityProvinceDropdown\Api\Data;

interface CitySearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get City list.
     *
     * @return \Bluethinkinc\CityProvinceDropdown\Api\Data\CityInterface[]
     */
    public function getItems();

    /**
     * Set region_id list.
     *
     * @param \Bluethinkinc\CityProvinceDropdown\Api\Data\CityInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
