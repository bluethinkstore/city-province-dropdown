<?php
declare(strict_types=1);

namespace Bluethinkinc\CityProvinceDropdown\Api;

interface GetUrlRepositoryInterfaceManagementInterface
{
    /**
     * Post get Url repository Interface
     *
     * @param string $value
     * @return string
     */
    public function postGetUrlRepositoryInterface(string $value): string;
}
