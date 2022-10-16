<?php

namespace Profair\ProductBooking\Block\Product\View;

/**
 * Class BookProduct
 *
 * @package Profair\ProductBooking\Block\Product\View
 */
class BookProduct extends \Magento\Catalog\Block\Product\View
{
    /**
     * @return string
     */
    public function getActionUrl()
    {
        return $this->getUrl('booking/book/product');
    }
}