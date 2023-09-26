<?php
declare(strict_types=1);

namespace Bluethinkinc\CityProvinceDropdown\Api;

use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Exception\NoSuchEntityException;

interface RegionRepositoryInterface
{
    /**
     * Retrieve Region List.
     *
     * @return string
     * @throws NoSuchEntityException
     */
    public function getRegion(): string;
}
