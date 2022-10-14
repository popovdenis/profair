<?php

namespace Profair\ProductBooking\Block\Adminhtml\ProductBooking\Edit\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveAndContinue
 *
 * @package Dhs\ImportProfile\Block\Adminhtml\ImportProfile\Edit\Buttons
 */
class SaveAndContinue extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label'          => __('Save and Continue Edit'),
            'class'          => 'save',
            'data_attribute' => [
                'mage-init' => [
                    'button' => ['event' => 'saveAndContinueEdit'],
                ],
            ],
            'sort_order'     => 200,
        ];
    }
}