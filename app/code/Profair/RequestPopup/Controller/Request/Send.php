<?php

namespace Profair\RequestPopup\Controller\Request;

use Magento\Framework\App\ResponseInterface;

/**
 * Class Send
 *
 * @package Profair\RequestPopup\Controller\Request
 */
class Send extends \Magento\Framework\App\Action\Action
{
    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     */
    public function execute()
    {
        /* @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        $this->messageManager->addSuccessMessage(__('The request was sent successfully'));

        return $resultRedirect->setPath('*/');
    }
}