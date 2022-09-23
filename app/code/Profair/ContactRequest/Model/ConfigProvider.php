<?php

namespace Profair\ContactRequest\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class ConfigProvider
 *
 * @package Profair\ContactRequest\Model
 */
class ConfigProvider
{
    /**
     * Config path for approval workflow enabled
     *
     * @var string
     */
    const CONFIG_PATH_PROFAIR_CONTACT_ENABLED = 'profair_contact/general/enabled';
    /**
     * @var string
     */
    const CONFIG_PATH_RECIPIENT_EMAIL_DAYS = 'profair_contact/send_request_integration/recipient_email';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * Config constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Returns approval workflow integration status.
     *
     * @param string|null $storeId
     *
     * @return bool
     */
    public function isEnabled(?string $storeId = null): bool
    {
        return (bool) $this->scopeConfig->getValue(
            static::CONFIG_PATH_PROFAIR_CONTACT_ENABLED,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Get recipient email
     *
     * @param string|null $storeId
     *
     * @return string
     */
    public function getRecipientEmail(?string $storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::CONFIG_PATH_RECIPIENT_EMAIL_DAYS,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}