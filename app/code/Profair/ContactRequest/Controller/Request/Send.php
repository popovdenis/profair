<?php

namespace Profair\ContactRequest\Controller\Request;

use Profair\ContactRequest\Model\ConfigProvider;
use Profair\ContactRequest\Model\Mail\Sender;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\DataObjectFactory as ObjectFactory;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\View\LayoutInterface;

/**
 * Class Send
 *
 * @package Profair\ContactRequest\Controller\Request
 */
class Send extends \Magento\Framework\App\Action\Action
{
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
     * @var \Magento\Framework\Mail\Template\TransportBuilder
     */
    private $transportBuilder;
    /**
     * @var \Profair\ContactRequest\Model\ConfigProvider
     */
    private $configProvider;
    /**
     * @var \Profair\ContactRequest\Model\Mail\Sender
     */
    private $sender;

    /**
     * Send constructor.
     *
     * @param \Magento\Framework\App\Action\Context             $context
     * @param \Magento\Framework\Data\Form\FormKey\Validator    $formKeyValidator
     * @param \Magento\Framework\DataObjectFactory              $objectFactory
     * @param \Magento\Framework\Serialize\Serializer\Json      $serialize
     * @param \Magento\Framework\View\LayoutInterface           $layout
     * @param \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
     * @param \Profair\ContactRequest\Model\ConfigProvider        $configProvider
     */
    public function __construct(
        Context $context,
        Validator $formKeyValidator,
        ObjectFactory $objectFactory,
        Json $serialize,
        LayoutInterface $layout,
        TransportBuilder $transportBuilder,
        ConfigProvider $configProvider,
        Sender $sender
    )
    {
        parent::__construct($context);
        $this->formKeyValidator = $formKeyValidator;
        $this->objectFactory = $objectFactory;
        $this->serialize = $serialize;
        $this->layout = $layout;
        $this->transportBuilder = $transportBuilder;
        $this->configProvider = $configProvider;
        $this->sender = $sender;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     */
    public function execute()
    {
        $senderData = $this->objectFactory->create();
        $senderData->setName($this->getRequest()->getParam('name'));
        $senderData->setPhone($this->getRequest()->getParam('phone'));
        $senderData->setEmail($this->getRequest()->getParam('email'));

        $recipientEmail = $this->configProvider->getRecipientEmail();

        $this->sender->sendContactEmail($senderData, $recipientEmail);

        $successBlock = $this->layout->createBlock('Magento\Cms\Block\Block')->setBlockId('send_request_success');
        $resultObject = [
            'success' => true,
            'message' => $successBlock->toHtml()
        ];

        return $this->getJsonResponse($resultObject);
    }

    private function getJsonResponse($result)
    {
        return $this->getResponse()->representJson(
            $this->serialize->serialize($result)
        );
    }
}