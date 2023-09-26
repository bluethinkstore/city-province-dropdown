<?php
declare(strict_types=1);

namespace Bluethinkinc\CityProvinceDropdown\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Directory\Model\RegionFactory;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Backend\App\Action\Context;
use Psr\Log\LoggerInterface;

class GetStateData extends Action
{
    /**
     * @var RegionFactory
     */
    private RegionFactory $regionColFactory;
    /**
     * @var JsonFactory
     */
    private JsonFactory $resultJsonFactory;
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param RegionFactory $regionColFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context  $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Directory\Model\RegionFactory $regionColFactory,
        LoggerInterface $logger,
    ) {
        $this->regionColFactory = $regionColFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->logger = $logger;
        parent::__construct($context);
    }

    /**
     * Execute execute
     *
     * @return Json
     */
    public function execute(): Json
    {
        $result = $this->resultJsonFactory->create();
        $regions = $this->regionColFactory->create()
            ->getCollection()->addFieldToFilter('country_id', $this->getRequest()
            ->getParam('value'));
        return $result->setData(['success' => true,'value'=>$regions->getData()]);
    }
}
