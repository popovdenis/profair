<?php

namespace Profair\ProductBooking\Block\Product;

/**
 * Class BookProduct
 *
 * @package Profair\ProductBooking\Block\Product
 */
class BookProduct extends \Magento\Catalog\Block\Product\ListProduct
{
    /**
     * @return string
     */
    public function getActionUrl()
    {
        return $this->getUrl('profair_booking/book/product');
    }
}