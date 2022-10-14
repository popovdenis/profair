<?php

namespace Profair\ProductBooking\Model\ResourceModel;

/**
 * Class ProductBooking
 *
 * @package Profair\ProductBooking\Model\ResourceModel
 */
class ProductBooking extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('profair_product_book', 'entity_id');
    }
}