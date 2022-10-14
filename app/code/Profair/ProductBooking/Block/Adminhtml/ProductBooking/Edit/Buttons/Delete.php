<?php

namespace Profair\ProductBooking\Block\Adminhtml\ProductBooking\Edit\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class Delete
 *
 * @package Profair\ProductBooking\Block\Adminhtml\ProductBooking\Edit\Buttons
 */
class Delete extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getBookingProductId()) {
            $data = [
                'label'      => __('Delete Booked Product'),
                'class'      => 'delete',
                'on_click'   => 'deleteConfirm(\''
                    . __('Booked product will be deleted. Are you sure you want to do this?')
                    . '\', \''
                    . $this->getDeleteUrl() . '\')',
                'sort_order' => 100,
            ];
        }

        return $data;
    }

    /**
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['entity_id' => $this->getBookingProductFromRequest()]);
    }
}