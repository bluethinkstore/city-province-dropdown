<?php
declare(strict_types=1);

namespace Bluethinkinc\CityProvinceDropdown\Block\Checkout;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\View\Element\Template;
use Bluethinkinc\CityProvinceDropdown\Model\City;
use Bluethinkinc\CityProvinceDropdown\Model\CityRepository;

/**
 * Class for Cities
 */
class Cities extends Template
{
    /** @var CityRepository */
    private CityRepository $cityRepository;

    /** @var SearchCriteriaBuilder */
    private SearchCriteriaBuilder $searchCriteria;

    /** @var SerializerInterface */
    private SerializerInterface $serializer;

    /**
     * @param Template\Context $context
     * @param CityRepository $cityRepository
     * @param SearchCriteriaBuilder $searchCriteria
     * @param SerializerInterface $serializer
     * @param array $data
     */
    public function __construct(
        Template\Context      $context,
        CityRepository     $cityRepository,
        SearchCriteriaBuilder $searchCriteria,
        SerializerInterface   $serializer,
        array                 $data = []
    ) {
        $this->searchCriteria = $searchCriteria;
        $this->cityRepository = $cityRepository;
        $this->serializer = $serializer;
        parent::__construct($context, $data);
    }

    /**
     * Cities Data
     *
     * @return bool|string
     * @throws LocalizedException
     */
    public function citiesJson(): bool|string
    {
        $searchCriteriaBuilder = $this->searchCriteria;
        $searchCriteria = $searchCriteriaBuilder->create();

        $citiesList = $this->cityRepository->getList($searchCriteria);
        $items = $citiesList->getItems();

        $return = [];

        /** @var City $item */
        foreach ($items as $item) {
            $return[] = ['region_id' => $item->getRegionId(), 'city_name' => $item->getCityName()];
        }
        asort($return);
        return $this->serializer->serialize($return);
    }
}
