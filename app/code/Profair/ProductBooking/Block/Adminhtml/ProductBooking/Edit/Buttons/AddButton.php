<?php

namespace Profair\ProductBooking\Block\Adminhtml\ProductBooking\Edit\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class AddButton
 *
 * @package Profair\ProductBooking\Block\Adminhtml\ProductBooking\Edit\Buttons
 */
class AddButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label'      => __('Add New'),
            'class'      => 'primary',
            'on_click'   => sprintf("location.href = '%s';", $this->getUrl('*/*/new')),
            'sort_order' => 10,
        ];
    }
}