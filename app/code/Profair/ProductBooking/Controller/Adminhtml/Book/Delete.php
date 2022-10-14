<?php

namespace Profair\ProductBooking\Controller\Adminhtml\Book;

use Exception;
use Profair\ProductBooking\Controller\Adminhtml\Book;

/**
 * Class Delete
 *
 * @package Profair\ProductBooking\Controller\Adminhtml\Book
 */
class Delete extends Book
{
    public function execute()
    {
        // check if we know what should be deleted
        $bookingId = $this->getRequest()->getParam('entity_id');

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($bookingId) {
            try {
                $booking = $this->bookingRepository->getById($bookingId);
                $this->bookingRepository->delete($booking);

                $this->messageManager->addSuccessMessage(__('The booked product has been deleted.'));

                return $resultRedirect->setPath('*/*/');
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());

                return $resultRedirect->setPath('*/*/edit', ['entity_id' => $bookingId]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a booked product to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}