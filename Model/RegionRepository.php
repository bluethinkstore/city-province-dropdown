<?php
declare(strict_types=1);

namespace Bluethinkinc\CityProvinceDropdown\Model;

use Bluethinkinc\CityProvinceDropdown\Api\RegionRepositoryInterface;
use Magento\Directory\Helper\Data as DirectoryData;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\Controller\Result\Json;

class RegionRepository implements RegionRepositoryInterface
{
    /**
     * @var DirectoryData
     */
    protected DirectoryData $directoryData;

    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;

    /**
     * @param DirectoryData $directoryData
     * @param SerializerInterface $serializer
     */
    public function __construct(
        DirectoryData $directoryData,
        SerializerInterface $serializer
    ) {
        $this->directoryData = $directoryData;
        $this->serializer = $serializer;
    }

    /**
     * @inheritDoc
     */
    public function getRegion(): string
    {
        return json_encode(json_decode($this->directoryData->getRegionJson()));
    }
}
