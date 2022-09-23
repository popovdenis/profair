<?php

namespace Profair\ContactRequest\Block\Request;

use Magento\Framework\View\Element\Template;

/**
 * Class Popup
 *
 * @package Profair\ContactRequest\Block\Request
 */
class Contact extends Template
{
    /**
     * @return string
     */
    public function getActionUrl()
    {
        return $this->getUrl('send_request/request/send');
    }
}