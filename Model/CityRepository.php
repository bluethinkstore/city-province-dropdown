<?php
declare(strict_types=1);

namespace Bluethinkinc\CityProvinceDropdown\Model;

use Bluethinkinc\CityProvinceDropdown\Api\CityRepositoryInterface;
use Bluethinkinc\CityProvinceDropdown\Api\Data\CityInterface;
use Bluethinkinc\CityProvinceDropdown\Api\Data\CityInterfaceFactory;
use Bluethinkinc\CityProvinceDropdown\Api\Data\CitySearchResultsInterfaceFactory;
use Bluethinkinc\CityProvinceDropdown\Model\ResourceModel\City as ResourceCity;
use Bluethinkinc\CityProvinceDropdown\Model\ResourceModel\City\CollectionFactory as CityCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class CityRepository implements CityRepositoryInterface
{

    /**
     * @var City
     */
    protected $searchResultsFactory;

    /**
     * @var CityCollectionFactory
     */
    protected $cityCollectionFactory;

    /**
     * @var CityInterfaceFactory
     */
    protected $cityFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected CollectionProcessorInterface $collectionProcessor;

    /**
     * @var ResourceCity
     */
    protected ResourceCity $resource;

    /**
     * @param ResourceCity $resource
     * @param CityInterfaceFactory $cityFactory
     * @param CityCollectionFactory $cityCollectionFactory
     * @param CitySearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceCity $resource,
        CityInterfaceFactory $cityFactory,
        CityCollectionFactory $cityCollectionFactory,
        CitySearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->cityFactory = $cityFactory;
        $this->cityCollectionFactory = $cityCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(CityInterface $city)
    {
        try {
            $this->resource->save($city);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the city: %1',
                $exception->getMessage()
            ));
        }
        return $city;
    }

    /**
     * @inheritDoc
     */
    public function get($cityId)
    {
        $city = $this->cityFactory->create();
        $this->resource->load($city, $cityId);
        if (!$city->getId()) {
            throw new NoSuchEntityException(__('City with id "%1" does not exist.', $cityId));
        }
        return $city;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->cityCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(CityInterface $city)
    {
        try {
            $cityModel = $this->cityFactory->create();
            $this->resource->load($cityModel, $city->getCityId());
            $this->resource->delete($cityModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the City: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($cityId)
    {
        return $this->delete($this->get($cityId));
    }
}
