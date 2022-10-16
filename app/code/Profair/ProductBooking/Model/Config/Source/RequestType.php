<?php

namespace Profair\ProductBooking\Model\Config\Source;

use Profair\ProductBooking\Api\Data\ProductBookingInterface;

/**
 * Class RequestType
 *
 * @package Profair\ProductBooking\Model\Config\Source
 */
class RequestType implements \Magento\Framework\Data\OptionSourceInterface
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
                'label' => 'Product Booking',
                'value' => ProductBookingInterface::REQUEST_TYPE_BOOKING
            ],
            [
                'label' => 'Customer Question',
                'value' => ProductBookingInterface::REQUEST_TYPE_QUESTION
            ]
        ];

        return $options;
    }
}