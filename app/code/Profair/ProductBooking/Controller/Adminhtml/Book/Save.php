<?php

namespace Profair\ProductBooking\Controller\Adminhtml\Book;

use Magento\Framework\Exception\LocalizedException;
use Profair\ProductBooking\Api\Data\ProductBookingInterface;
use Exception;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Profair\ProductBooking\Controller\Adminhtml\Book;
use Magento\Framework\App\Action\HttpPostActionInterface;
use RuntimeException;

/**
 * Class Save
 *
 * @package Profair\ProductBooking\Controller\Adminhtml\Book
 */
class Save extends Book implements HttpPostActionInterface
{
    /**
     * Save action.
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        $bookingData = $this->getRequest()->getPostValue();

        $resultRedirect = $this->resultRedirectFactory->create();

        if ($bookingData) {
            if ($bookingId = (int)$this->getRequest()->getParam('entity_id')) {
                try {
                    $booking = $this->bookingRepository->getById($bookingId);
                } catch (NoSuchEntityException $e) {
                    $booking = $this->bookingRepository->getEntityFactory();
                }
            } else {
                $booking = $this->bookingRepository->getEntityFactory();
                $bookingData['entity_id'] = null;
            }

            try {
                $this->dataObjectHelper->populateWithArray($booking, $bookingData, ProductBookingInterface::class);

                if ($booking->hasDataChanges()) {
                    $this->bookingRepository->save($booking);
                }

                $this->messageManager->addSuccessMessage(__('You saved this data.'));
                $this->_getSession()->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $booking->getId(), '_current' => true]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the data.'));
            }

            $this->_getSession()->setFormData($bookingData);

            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('entity_id')]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}