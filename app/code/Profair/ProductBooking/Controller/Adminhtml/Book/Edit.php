<?php

namespace Profair\ProductBooking\Controller\Adminhtml\Book;

use Profair\ProductBooking\Controller\Adminhtml\Book;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\App\Action\HttpPostActionInterface;

/**
 * Class Edit
 *
 * @package Profair\ProductBooking\Controller\Adminhtml\Book
 */
class Edit extends Book
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $bookingId = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($bookingId) {
            try {
                $booking = $this->bookingRepository->getById($bookingId);
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
            $this->coreRegistry->register('booking_product', $booking);
        } else {
            $booking = $this->bookingFactory->create();
            $this->coreRegistry->register('booking_product', $booking);
        }

        $resultPageTitle = $bookingId ? __('Edit Booking Product %1', $booking->getId()) : __('Add Booking Product');

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend($resultPageTitle);

        return $resultPage;
    }
}