<?php

declare(strict_types=1);

namespace Bluethinkinc\CityProvinceDropdown\Controller\City;

use Bluethinkinc\CityProvinceDropdown\Model\ResourceModel\City\CollectionFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Psr\Log\LoggerInterface;

class GetCityData extends Action
{
    /**
     * @var CollectionFactory
     */
    private CollectionFactory $regionColFactory;
    /**
     * @var JsonFactory
     */
    private JsonFactory $resultJsonFactory;
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * Construct method
     *
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param CollectionFactory $regionColFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context      $context,
        JsonFactory     $resultJsonFactory,
        CollectionFactory   $regionColFactory,
        LoggerInterface $logger,
    ) {
        $this->regionColFactory = $regionColFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->logger = $logger;
        return parent::__construct($context);
    }

    /**
     * Execute execute
     *
     * @return Json
     */
    public function execute(): Json
    {
        $result = $this->resultJsonFactory->create();
        $stateData = $this->regionColFactory->create()->addFieldToFilter('region_id', $this->getRequest()
            ->getParam('value'));
        return $result->setData(['success' => true, 'value' => $stateData->getData()]);
    }
}
