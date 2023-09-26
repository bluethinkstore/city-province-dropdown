<?php
declare(strict_types=1);

namespace Bluethinkinc\CityProvinceDropdown\Controller\Adminhtml\City;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

class Edit extends \Bluethinkinc\CityProvinceDropdown\Controller\Adminhtml\City
{

    /**
     * @var PageFactory
     */
    protected PageFactory $resultPageFactory;
    /**
     * @var Registry
     */
    private Registry $_coreRegistry;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return ResultInterface|Page
     */
    public function execute(): ResultInterface|Page
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('city_id');
        $model = $this->_objectManager->create(\Bluethinkinc\CityProvinceDropdown\Model\City::class);

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This City no longer exists.'));
                /** @var Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('bluethinkinc_cityprovincedropdown_city', $model);

        // 3. Build edit form
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit City') : __('New City'),
            $id ? __('Edit City') : __('New City')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Citys'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId()
            ? __('Edit City %1', $model->getId()) : __('New City'));
        return $resultPage;
    }
}
