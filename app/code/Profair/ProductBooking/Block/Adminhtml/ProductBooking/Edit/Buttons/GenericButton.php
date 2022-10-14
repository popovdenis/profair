<?php

namespace Profair\ProductBooking\Block\Adminhtml\ProductBooking\Edit\Buttons;

use Profair\ProductBooking\Api\ProductBookingRepositoryInterface;
use Magento\Backend\Block\Widget\Context;

/**
 * Class GenericButton
 *
 * @package Profair\ProductBooking\Block\Adminhtml\ProductBooking\Edit\Buttons
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;
    /**
     * @var \Profair\ProductBooking\Api\ProductBookingRepositoryInterface
     */
    private $bookingRepository;

    /**
     * GenericButton constructor.
     *
     * @param Context                                                       $context
     * @param \Profair\ProductBooking\Api\ProductBookingRepositoryInterface $bookingRepository
     */
    public function __construct(
        Context $context,
        ProductBookingRepositoryInterface $bookingRepository
    )
    {
        $this->context = $context;
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * @return string|null
     */
    public function getBookingProductId()
    {
        return $this->context->getRequest()->getParam('id');
    }

    /**
     * @return int|null
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getBookingProductFromRequest()
    {
        if ($bookingId = $this->getBookingProductId()) {
            return $this->bookingRepository->getById($bookingId)->getId();
        }

        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param string $route
     * @param array  $params
     *
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}