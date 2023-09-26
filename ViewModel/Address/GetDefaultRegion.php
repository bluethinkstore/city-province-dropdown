<?php

namespace Bluethinkinc\CityProvinceDropdown\ViewModel\Address;

use Magento\Customer\Model\Customer;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class GetDefaultRegion implements ArgumentInterface
{
    /**
     * @var Session
     */
    private Session $customerSession;

    /**
     * @param Session $customerSession
     */
    public function __construct(
        Session $customerSession
    ) {
        $this->customerSession = $customerSession;
    }

    /**
     * Get customer Data
     *
     * @return Customer
     */
    public function getCurrentCustomerId(): Customer
    {
        return $this->customerSession->getCustomerId();
    }
}
