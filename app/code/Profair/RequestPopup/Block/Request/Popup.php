<?php

namespace Profair\RequestPopup\Block\Request;

use Magento\Framework\View\Element\Template;

/**
 * Class Popup
 *
 * @package Profair\RequestPopup\Block\Request
 */
class Popup extends Template
{
    /**
     * @return string
     */
    public function getActionUrl()
    {
        return $this->getUrl('send_request/request/send');
    }
}