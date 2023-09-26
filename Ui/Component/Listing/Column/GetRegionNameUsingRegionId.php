<?php
namespace Bluethinkinc\CityProvinceDropdown\Ui\Component\Listing\Column;

use \Magento\Framework\View\Element\UiComponent\ContextInterface;
use \Magento\Framework\View\Element\UiComponentFactory;
use \Magento\Ui\Component\Listing\Columns\Column;
use \Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Directory\Model\RegionFactory;

class GetRegionNameUsingRegionId extends Column
{
    /**
     * @var ContextInterface
     */
    protected $context;

    /**
     * @var UiComponentFactory
     */
    protected $uiComponentFactory;

    /**
     * @var SearchCriteriaBuilder
     */
    protected SearchCriteriaBuilder $criteria;

    /**
     * @var RegionFactory
     */
    protected RegionFactory $cityFactory;

    /**
     * Construct function
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param SearchCriteriaBuilder $criteria
     * @param RegionFactory $cityFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        SearchCriteriaBuilder $criteria,
        RegionFactory $cityFactory,
        array $components = [],
        array $data = []
    ) {
        $this->cityFactory = $cityFactory;
        $this->_searchCriteria  = $criteria;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare data source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $regionIdData  = $item["region_id"];
                $city = $this->cityFactory->create()->load($regionIdData);
                $title = $city->getName();
                $item[$this->getData('name')] = $title;
            }
        }
        return $dataSource;
    }
}
