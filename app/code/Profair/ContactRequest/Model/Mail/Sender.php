<?php

namespace Profair\ContactRequest\Model\Mail;

use Magento\Framework\App\Area;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class Sender
 *
 * @package Profair\ContactRequest\Model\Mail
 */
class Sender
{
    /**
     * @var \Magento\Framework\Mail\Template\TransportBuilder
     */
    private $transportBuilder;
    /**
     * @var \Magento\Store\Api\StoreRepositoryInterface
     */
    protected $storeRepository;
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * Sender constructor.
     *
     * @param \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
     * @param \Magento\Store\Api\StoreRepositoryInterface       $storeRepository
     * @param \Psr\Log\LoggerInterface                          $logger
     */
    public function __construct(
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Store\Api\StoreRepositoryInterface $storeRepository,
        \Psr\Log\LoggerInterface $logger
    )
    {
        $this->transportBuilder = $transportBuilder;
        $this->storeRepository = $storeRepository;
        $this->logger = $logger;
    }

    /**
     * @param \Magento\Framework\DataObject $senderData
     * @param string                        $recipientEmail
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\MailException
     */
    public function sendContactEmail(DataObject $senderData, string $recipientEmail)
    {
        $templateParams = [
            'contact_name' => $senderData->getName(),
            'contact_phone' => $senderData->getPhone(),
            'contact_email' => $senderData->getEmail()
        ];

        $this->configureEmailTemplate($templateParams);

        $this->transportBuilder->addTo($recipientEmail, $recipientEmail);

        $transport = $this->transportBuilder->getTransport();
        $transport->sendMessage();
//        try {
//            $recipient = [[
//                'email'     => $recipientEmail,
//                'fullName'  => $recipientEmail,
//            ]];
//
//
//
//            $this->transportBuilder->setTemplateIdentifier('profair_contact_request')
//                ->setTemplateOptions(['area' => Area::AREA_FRONTEND, 'store' => $this->getDefaultStoreId()])
//                ->setTemplateVars($templateParams)
//                ->setFromByScope(['email' => $recipientEmail, 'name' => 'Profair Contact Request']);
//            $this->addRecipients($recipient);
//
//            $this->transportBuilder->getTransport()->sendMessage();
//        } catch (\Exception $e) {
//            $this->logger->critical('Error while sending email. ' . $e->getMessage());
//        }
    }

    /**
     * Configure email template
     *
     * @return void
     * @throws \Magento\Framework\Exception\MailException
     */
    protected function configureEmailTemplate(array $templateParams)
    {
        $this->transportBuilder->setTemplateIdentifier('profair_contact_request');
        $this->transportBuilder->setTemplateOptions([
            'area' => Area::AREA_FRONTEND,
            'store' => $this->getDefaultStoreId()
        ]);
        $this->transportBuilder->setTemplateVars($templateParams);
        $this->transportBuilder->setFromByScope(
            [
                'name' => 'denispopov2112@gmail.com',
                'email' => 'denispopov2112@gmail.com'
            ],
            $this->getDefaultStoreId()
        );
    }

    /**
     * Add list of recipients to transport builder
     *
     * @param array $recipients
     */
    private function addRecipients(array $recipients)
    {
        foreach ($recipients as $recipient) {
            $this->transportBuilder->addTo($recipient['email'], $recipient['fullName']);
        }
    }

    /**
     * Get default store.
     *
     * @return int
     */
    private function getDefaultStoreId()
    {
        try {
            $store = $this->storeRepository->get('default');
            if ($store && $store->getId()) {
                return $store->getId();
            }
        } catch (NoSuchEntityException $e) {
        }

        return 1;
    }
}