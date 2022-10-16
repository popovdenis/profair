<?php

namespace Profair\ProductBooking\Model;

use Magento\Framework\Model\AbstractModel;
use Profair\ProductBooking\Api\Data\ProductBookingInterface;

/**
 * Class ProductBooking
 *
 * @package Profair\ProductBooking\Model
 */
class ProductBooking extends AbstractModel implements ProductBookingInterface
{
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'atom_approval_workflow';

    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init(\Profair\ProductBooking\Model\ResourceModel\ProductBooking::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getId(): ?int
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setId($id): ProductBookingInterface
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    /**
     * {@inheritdoc}
     */
    public function getProductSku(): ?string
    {
        return $this->getData(self::PRODUCT_SKU);
    }

    /**
     * {@inheritdoc}
     */
    public function setProductSku($sku): ProductBookingInterface
    {
        return $this->setData(self::PRODUCT_SKU, $sku);
    }

    /**
     * {@inheritdoc}
     */
    public function getContactName(): ?string
    {
        return $this->getData(self::CONTACT_NAME);
    }

    /**
     * {@inheritdoc}
     */
    public function setContactName($contactName): ProductBookingInterface
    {
        return $this->setData(self::CONTACT_NAME, $contactName);
    }

    /**
     * {@inheritdoc}
     */
    public function getContactPhone(): ?string
    {
        return $this->getData(self::CONTACT_PHONE);
    }

    /**
     * {@inheritdoc}
     */
    public function setContactPhone($contactPhone): ProductBookingInterface
    {
        return $this->setData(self::CONTACT_PHONE, $contactPhone);
    }

    /**
     * {@inheritdoc}
     */
    public function getContactEmail(): ?string
    {
        return $this->getData(self::CONTACT_EMAIL);
    }

    /**
     * {@inheritdoc}
     */
    public function setContactEmail($contactEmail): ProductBookingInterface
    {
        return $this->setData(self::CONTACT_EMAIL, $contactEmail);
    }

    /**
 * {@inheritdoc}
 */
    public function getStatus(): ?string
    {
        return $this->getData(self::STATUS);
    }

    /**
     * {@inheritdoc}
     */
    public function setStatus($status): ProductBookingInterface
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestType(): ?string
    {
        return $this->getData(self::REQUEST_TYPE);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequestType($requestType): ProductBookingInterface
    {
        return $this->setData(self::REQUEST_TYPE, $requestType);
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt(): string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(string $createdAt): ProductBookingInterface
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt(): string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdatedAt(string $updatedAt): ProductBookingInterface
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}