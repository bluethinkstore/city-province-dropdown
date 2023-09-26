<?php
declare(strict_types=1);

namespace Bluethinkinc\CityProvinceDropdown\Model;

use Bluethinkinc\CityProvinceDropdown\Api\GetUrlRepositoryInterfaceManagementInterface;
use Bluethinkinc\CityProvinceDropdown\Model\ResourceModel\City\CollectionFactory;

class GetUrlRepositoryInterfaceManagement implements GetUrlRepositoryInterfaceManagementInterface
{

    /**
     * @var CollectionFactory
     */
    private CollectionFactory $regionColFactory;

    /**
     * @param CollectionFactory $regionColFactory
     */
    public function __construct(
        CollectionFactory $regionColFactory,
    ) {
        $this->regionColFactory = $regionColFactory;
    }

    /**
     * Post get url repository Interface
     *
     * @param string $value
     * @return string
     */
    public function postGetUrlRepositoryInterface(string $value): string
    {
        try {
            $stateData = $this->regionColFactory->create()->addFieldToFilter('region_id', $value);
            $response = ['success' => true, 'value' => $stateData->getData()];
        } catch (\Exception $e) {
            $response = ['success' => false];
        }
        return json_encode($response);
    }
}
