<?php

namespace Profair\ProductBooking\Controller\Adminhtml\Book;

use Profair\ProductBooking\Controller\Adminhtml\Book;

/**
 * Class Index
 *
 * @package Profair\ProductBooking\Controller\Adminhtml\Book
 */
class Index extends Book
{
    /**
     * Items list.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Magento_Backend::stores');
        $resultPage->getConfig()->getTitle()->prepend(__('Booking Products'));
        $resultPage->addBreadcrumb(__('Products'), __('Products'));
        $resultPage->addBreadcrumb(__('Booking Products'), __('Products'));

        return $resultPage;
    }
}