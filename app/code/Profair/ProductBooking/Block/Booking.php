<?php

namespace Profair\ProductBooking\Block;

/**
 * Class Booking
 *
 * @package Profair\ProductBooking\Block
 */
class Booking extends \Magento\Framework\View\Element\Template
{
    /**
     * @return \Magento\Framework\View\Element\Template
     */
    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Booking Product'));

        return parent::_prepareLayout();
    }
}