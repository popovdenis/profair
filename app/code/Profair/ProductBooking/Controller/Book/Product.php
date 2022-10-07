<?php

namespace Profair\ProductBooking\Controller\Book;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\View\LayoutInterface;

/**
 * Class Product
 *
 * @package Profair\ProductBooking\Controller\Book
 */
class Product extends Action
{
    /**
     * @var \Magento\Framework\Controller\Result\ForwardFactory
     */
    private $resultForwardFactory;
    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    private $jsonSerializer;
    /**
     * @var \Magento\Framework\View\LayoutInterface
     */
    private $layout;

    /**
     * Product constructor.
     *
     * @param \Magento\Framework\App\Action\Context               $context
     * @param \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory
     * @param \Magento\Framework\Serialize\Serializer\Json        $jsonSerializer
     * @param \Magento\Framework\View\LayoutInterface             $layout
     */
    public function __construct(
        Context $context,
        ForwardFactory $resultForwardFactory,
        Json $jsonSerializer,
        LayoutInterface $layout
    )
    {
        parent::__construct($context);
        $this->resultForwardFactory = $resultForwardFactory;
        $this->jsonSerializer = $jsonSerializer;
        $this->layout = $layout;
    }

    /**
     * Executes controller action.
     *
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $request = $this->getRequest();

        if (!$request->isAjax()) {
            $resultForward = $this->resultForwardFactory->create();
            $resultForward->forward('noroute');

            return $resultForward;
        }

        $successBlock = $this->layout->createBlock('Magento\Cms\Block\Block')->setBlockId('book_product_response');
        $result = [
            'message' => $successBlock->toHtml()
        ];

        return $this->getResponse()
            ->setHeader('Cache-Control', 'max-age=0, must-revalidate, no-cache, no-store', true)
            ->setHeader('Pragma', 'no-cache', true)
            ->representJson(
                $this->jsonSerializer->serialize($result)
            );
    }
}