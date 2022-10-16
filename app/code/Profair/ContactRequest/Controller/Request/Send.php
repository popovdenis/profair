<?php

namespace Profair\ContactRequest\Controller\Request;

use Magento\Framework\Controller\Result\ForwardFactory;
use Profair\ContactRequest\Model\ConfigProvider;
use Profair\ContactRequest\Model\Mail\Sender;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\DataObjectFactory as ObjectFactory;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\View\LayoutInterface;
use Profair\ProductBooking\Api\Data\ProductBookingInterface;
use Profair\ProductBooking\Api\ProductBookingRepositoryInterface;

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
     * @var \Profair\ProductBooking\Api\ProductBookingRepositoryInterface
     */
    private $bookingRepository;
    /**
     * @var \Magento\Framework\Controller\Result\ForwardFactory
     */
    private $resultForwardFactory;

    /**
     * Send constructor.
     *
     * @param \Magento\Framework\App\Action\Context                         $context
     * @param \Magento\Framework\Data\Form\FormKey\Validator                $formKeyValidator
     * @param \Magento\Framework\DataObjectFactory                          $objectFactory
     * @param \Magento\Framework\Serialize\Serializer\Json                  $serialize
     * @param \Magento\Framework\View\LayoutInterface                       $layout
     * @param \Magento\Framework\Mail\Template\TransportBuilder             $transportBuilder
     * @param \Profair\ContactRequest\Model\ConfigProvider                  $configProvider
     * @param \Profair\ContactRequest\Model\Mail\Sender                     $sender
     * @param \Magento\Framework\Controller\Result\ForwardFactory           $resultForwardFactory
     * @param \Profair\ProductBooking\Api\ProductBookingRepositoryInterface $bookingRepository
     */
    public function __construct(
        Context $context,
        Validator $formKeyValidator,
        ObjectFactory $objectFactory,
        Json $serialize,
        LayoutInterface $layout,
        TransportBuilder $transportBuilder,
        ConfigProvider $configProvider,
        Sender $sender,
        ForwardFactory $resultForwardFactory,
        ProductBookingRepositoryInterface $bookingRepository
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
        $this->resultForwardFactory = $resultForwardFactory;
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     */
    public function execute()
    {
        $request = $this->getRequest();

        if (!$request->isAjax()) {
            return $this->getJsonResponse([
                'success' => false,
                'message' => __('Bad request')
            ]);
        }

        $booking = $this->getBookingEntity();
        $this->bookingRepository->save($booking);

        $senderData = $this->objectFactory->create();
        $senderData->setName($booking->getContactName());
        $senderData->setPhone($booking->getContactPhone());
        $senderData->setEmail($booking->getContactEmail());

        $this->sender->sendContactEmail($senderData, $this->configProvider->getRecipientEmail());

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

    private function getBookingEntity()
    {
        $booking = $this->bookingRepository->getEntityFactory();
        $booking->setContactName($this->getRequest()->getParam('name'));
        $booking->setContactPhone($this->getRequest()->getParam('phone'));
        $booking->setContactEmail($this->getRequest()->getParam('email'));
        $booking->setStatus(ProductBookingInterface::BOOKING_PRODUCT_STATUS_OPEN);
        $booking->setRequestType(ProductBookingInterface::REQUEST_TYPE_QUESTION);

        return $booking;
    }
}