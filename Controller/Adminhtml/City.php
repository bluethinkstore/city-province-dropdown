<?php
declare(strict_types=1);

namespace Bluethinkinc\CityProvinceDropdown\Controller\Adminhtml;

use Magento\Backend\Model\View\Result\Page;

abstract class City extends \Magento\Backend\App\Action
{
    public const ADMIN_RESOURCE = 'Bluethinkinc_CityProvinceDropdown::top_level';

    /**
     * Init page
     *
     * @param Page $resultPage
     * @return Page
     */
    public function initPage($resultPage): Page
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Bluethinkinc'), __('Bluethinkinc'))
            ->addBreadcrumb(__('City'), __('City'));
        return $resultPage;
    }
}
