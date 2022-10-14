<?php

namespace Profair\ProductBooking\Controller\Adminhtml\Book;

use Profair\ProductBooking\Controller\Adminhtml\Book;

/**
 * Class NewAction
 *
 * @package Profair\ProductBooking\Controller\Adminhtml\Book
 */
class NewAction extends Book
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $this->_forward('edit');
    }
}