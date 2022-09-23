<?php

namespace Profair\RequestPopup\Controller\Request;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\DataObjectFactory as ObjectFactory;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\View\LayoutInterface;

/**
 * Class Send
 *
 * @package Profair\RequestPopup\Controller\Request
 */
class Send extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\Data\Form\FormKey\Validator
     */
    protected $_formKeyValidator;
    /**
     * @var \Magento\Framework\Data\Form\FormKey\Validator
     */
    private $formKeyValidator;
    /**
     * @var ObjectFactory
     */
    private $objectFactory;
    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    private $serialize;
    /**
     * @var \Magento\Framework\View\LayoutInterface
     */
    protected $layout;

    /**
     * Send constructor.
     *
     * @param \Magento\Framework\App\Action\Context          $context
     * @param \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
     * @param \Magento\Framework\DataObjectFactory           $objectFactory
     * @param \Magento\Framework\Serialize\Serializer\Json   $serialize
     * @param \Magento\Framework\View\LayoutInterface        $layout
     */
    public function __construct(
        Context $context,
        Validator $formKeyValidator,
        ObjectFactory $objectFactory,
        Json $serialize,
        LayoutInterface $layout
    )
    {
        parent::__construct($context);
        $this->formKeyValidator = $formKeyValidator;
        $this->objectFactory = $objectFactory;
        $this->serialize = $serialize;
        $this->layout = $layout;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     */
    public function execute()
    {
//        if (!$this->formKeyValidator->validate($this->getRequest())) {
//            $message = __('We can\'t add this item to your shopping cart right now. Please reload the page.');
//            $resultObject = $this->objectFactory->create(['success' => false, 'message' => $message]);
//
//            return $this->getJsonResponse($resultObject);
//        }

        $successBlock = $this->layout->createBlock('Magento\Cms\Block\Block')->setBlockId('send_request_success');
        $resultObject = [
            'success' => true,
            'message' => $successBlock->toHtml()
        ];

        return $this->getJsonResponse($resultObject);
    }

    private function getJsonResponse($result)
    {
        $resultObject = $this->objectFactory->create(['data' => ['result' => $result]]);

        return $this->getResponse()->representJson(
            $this->serialize->serialize($result)
        );
    }
}