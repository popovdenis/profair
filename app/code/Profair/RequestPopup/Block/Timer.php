<?php

namespace Profair\RequestPopup\Block;

/**
 * Class Timer
 *
 * @package Profair\RequestPopup\Block
 */
class Timer extends \Magento\Framework\View\Element\Template
{
    public function isCountdownEnabled()
    {
        return true;
    }

    public function getCountdownEndDate()
    {
        return (new \DateTime())->add(new \DateInterval('PT2H'))->format('Y/m/d H:i:s');
    }
}