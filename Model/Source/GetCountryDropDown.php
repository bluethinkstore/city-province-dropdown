<?php
namespace Bluethinkinc\CityProvinceDropdown\Model\Source;

use Magento\Directory\Model\CountryFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Json\Helper\Data;

class GetCountryDropDown extends \Magento\Framework\App\Action\Action
{
    /**
     * @var PageFactory
     */
    protected PageFactory $resultPageFactory;

    /**
     * @var CountryFactory
     */
    protected CountryFactory $_countryFactory;

    /**
     * @var Data
     */
    protected Data $data;
    /**
     * @param Context $context
     * @param CountryFactory $countryFactory
     * @param PageFactory $resultPageFactory
     * @param Data $data
     */
    public function __construct(
        Context  $context,
        CountryFactory    $countryFactory,
        PageFactory $resultPageFactory,
        Data $data
    ) {
        $this->_countryFactory = $countryFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->data =$data;
        parent::__construct($context);
    }

    /**
     * Execute first run
     *
     * @return void
     */
    public function execute(): void
    {
        $countrycode = $this->getRequest()->getParam('country');
        $state = "<option value=''>--Please Select--</option>";
        if ($countrycode != '') {
            $statearray = $this->_countryFactory->create()->setId(
                $countrycode
            )->getLoadedRegionCollection()->toOptionArray();
            foreach ($statearray as $_state) {
                if ($_state['value']) {
                    $state .= "<option >" . $_state['label'] . "</option>";
                }
            }
        }
        $result['htmlconent'] = $state;
        $this->getResponse()->representJson(
            $this->data->jsonEncode($result)
        );
    }
}
