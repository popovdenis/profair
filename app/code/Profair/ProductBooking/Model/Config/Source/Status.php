<?php

namespace Profair\ProductBooking\Model\Config\Source;

use Profair\ProductBooking\Api\Data\ProductBookingInterface;

/**
 * Class Status
 *
 * @package Profair\ProductBooking\Model\Config\Source
 */
class Status implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            [
                'label' => '-- Please select --',
                'value' => 0
            ],
            [
                'label' => 'Open',
                'value' => ProductBookingInterface::BOOKING_PRODUCT_STATUS_OPEN
            ],
            [
                'label' => 'In Progress',
                'value' => ProductBookingInterface::BOOKING_PRODUCT_STATUS_IN_PROGRESS
            ],
            [
                'label' => 'Closed',
                'value' => ProductBookingInterface::BOOKING_PRODUCT_STATUS_CLOSED
            ],
        ];

        return $options;
    }
}