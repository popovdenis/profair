<?php

namespace Profair\ProductBooking\Model\ResourceModel\ProductBooking;

/**
 * Class Collection
 *
 * @package Profair\ProductBooking\Model\ResourceModel\ProductBooking
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';

    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            \Profair\ProductBooking\Model\ProductBooking::class,
            \Profair\ProductBooking\Model\ResourceModel\ProductBooking::class
        );
    }
}